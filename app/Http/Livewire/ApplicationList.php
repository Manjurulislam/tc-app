<?php

namespace App\Http\Livewire;

use App\Enum\ApplicationStatus;
use App\Models\Application;
use App\Models\ApproveApplication;
use App\Models\Comment;
use App\Models\User;
use App\Service\DataService;
use App\Service\SmsService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithPagination;

class ApplicationList extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    protected $queryString     = ['search'];
    public    $search, $details, $status, $comments, $sharok_no, $appId, $commentId;

    public $isRevert, $detailsItems;
    public            $multipleSelect = [];


    public function mount()
    {
        $admin = auth()->user();
        $role  = data_get($admin, 'user_role');

        if ($role == 2) {
            $this->comments = Comment::whereIn('id', [9, 10])->get();
        } else {
            $this->comments = Comment::latest()->get();
        }
    }


    public function render()
    {
        return view('livewire.application-list', ['items' => $this->applications()]);
    }


    public function applications()
    {
        $user      = auth()->guard('web')->user();
        $isCollege = Str::contains(data_get(auth()->guard('web')->user(), 'user_role'), 2);
        $query     = Application::latest();

        if ($this->search) {
            $query->where(function ($query) {
                $query->where('from_college_eiin', 'like', '%' . $this->search . '%')
                    ->orWhere('to_college_eiin', 'like', '%' . $this->search . '%')
                    ->orWhereHas('student', function ($q) {
                        $q->where('name', 'like', '%' . $this->search . '%')
                            ->orWhere('father_name', 'like', '%' . $this->search . '%')
                            ->orWhere('phone', 'like', '%' . $this->search . '%');
                    });
            });
        }

        if ($isCollege) {
            $query->whereHas('approves', function ($q) use ($user) {
                $q->where(['user_id' => data_get($user, 'id'), 'is_approved' => 0]);
            });
        }
        $data = $query->pending()->paginate(30);
        return app(DataService::class)->transformApplicationList($data);
    }

    public function updateStatus($id)
    {
        $approve        = ApproveApplication::find($id);
        $this->appId    = $id;
        $this->isRevert = data_get($approve, 'is_revert');
    }

    public function details($id)
    {
        $this->detailsItems = Application::find($id);
    }

    /**
     * @throws \Throwable
     */
    public function approved()
    {
        $this->validate([
            'commentId' => 'required',
        ], ['commentId.required' => 'Comment is required']);

        DB::beginTransaction();
        try {

            $user      = '';
            $revert    = 0;
            $status    = 0;
            $admin     = auth()->user();
            $role      = data_get($admin, 'user_role');
            $userEiin  = data_get($admin, 'eiin_no');
            $userId    = data_get($admin, 'id');
            $isCollege = User::where(['eiin_no' => $userEiin, 'user_role' => 2])->exists();
            $approve   = ApproveApplication::where('application_id', $this->appId)->where(['user_id' => $userId, 'is_approved' => 0])->first();

            if (!$approve->is_revert) {

                if ($isCollege) {
                    $user = $this->approveCollege($approve);
                } else {
                    // admin approve process
                    if ($role == 3) { // 1st admin pass to 2nd admin
                        $user = $this->getUserByRole(4); // 2nd admin
                    } elseif ($role == 4) { // 2nd admin pass to 1st admin
                        $revert = 1;
                        $status = 1;
                        $user   = $this->getUserByRole(3);
                    }
                }
            } else {
                $revert = 1;
                $status = 1;
                if ($role == 3) {
                    $approve->applications->update(['status' => 2, 'sharok_no' => $this->sharok_no,]);
                }
            }
            $this->bypassApplication($approve, data_get($user, 'id'), $revert, $status);
            DB::commit();
        } catch (\Exception $e) {
            Log::error($e);
            $this->alert('error', 'Something went wrong');
            DB::rollBack();
        }
    }


    /**
     * @throws \Throwable
     */
    public function bulkApproved()
    {
        $this->validate([
            'commentId' => 'required',
        ], ['commentId.required' => 'Comment is required']);

        DB::beginTransaction();
        try {
            $user         = '';
            $revert       = 0;
            $status       = 0;
            $admin        = auth()->user();
            $role         = data_get($admin, 'user_role');
            $userId       = data_get($admin, 'id');
            $applications = ApproveApplication::whereIn('application_id', $this->multipleSelect)
                ->where(['user_id' => $userId, 'is_approved' => 0])->get();


            if (!blank($applications)) {

                foreach ($applications as $approve) {

                    $userEiin  = data_get($admin, 'eiin_no');
                    $isCollege = User::where(['eiin_no' => $userEiin, 'user_role' => 2])->exists();

                    if (!$approve->is_revert) {
                        //============= college approve
                        if ($isCollege) {
                            $user = $this->approveCollege($approve);
                            //========== end college =========
                        } else {
                            if ($role == 3) { // 1st admin pass to 2nd admin
                                $user = $this->getUserByRole(4); // 2nd admin
                            } elseif ($role == 4) { // 3d admin revert again to 2nd admin
                                $revert = 1;
                                $status = 1;
                                $user   = $this->getUserByRole(3); //back 2nd admin
                            }
                        }
                    } else {
                        $revert = 1;
                        $status = 1;

                        if ($role == 3) {
                            $approve->applications->update(['status' => 2, 'sharok_no' => $this->sharok_no,]);
                        }
                    }
                    $this->bypassApplication($approve, data_get($user, 'id'), $revert, $status);
                }
            }
            DB::commit();
        } catch (\Exception $e) {
            Log::error($e);
            $this->alert('error', 'Something went wrong');
            DB::rollBack();
        }
    }


    public function approveCollege($approve)
    {
        $admin        = auth()->user();
        $role         = data_get($admin, 'user_role');
        $admissionCol = data_get($approve, 'applications.to_college_eiin');
        $collegeUser  = '';

        if ($approve->is_parent && $role == 2) {
            //first college pass 2nd college
            $collegeUser = User::where('eiin_no', $admissionCol)->first();
        } elseif (!$approve->is_parent && $role == 2) {  //2nd college pass to first admin
            $collegeUser = $this->getUserByRole(3); //1
            //sms send student
            $phone   = data_get($approve, 'applications.student.phone');
            $message = "Both college approved your application now you can pay through sonali seba below link \nhttp://sonali-e-sheba.dinajpurboard.gov.bd";
            app(SmsService::class)->post($phone, $message);
        }
        return $collegeUser;
    }

    protected function getUserByRole($role)
    {
        return User::where('user_role', $role)->first();
    }

    protected function bypassApplication($approve, $userId, $revert = 0, $status = 1)
    {
        $approve->update([
            'is_approved' => 1,
            'comment_id'  => $this->commentId,
            'approve_at'  => now()->toDateTimeString(),
            'is_revert'   => $revert,
            'status'      => $status
        ]);

        if ($userId) {
            $approve->create([
                'application_id' => data_get($approve, 'applications.id'),
                'parent_id'      => data_get($approve, 'id'),
                'user_id'        => $userId,
                'is_revert'      => $revert,
            ]);
        }
    }
}
