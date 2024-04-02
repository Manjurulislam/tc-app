<?php

namespace App\Http\Livewire;

use App\Enum\ApplicationStatus;
use App\Models\Application;
use App\Models\ApproveApplication;
use App\Models\CollegeDetails;
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
            $this->comments = Comment::whereIn('id', [2, 3])->get();
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
        $query     = Application::query();

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
        $data = $query->pending()->paginate(100);
        return app(DataService::class)->transformApplicationList($data);
    }

    public function updateStatus($id)
    {
        $this->appId    = $id;
        $this->isRevert = ApproveApplication::where('application_id', $this->appId)->where('is_revert', 1)->exists();
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

            $user     = '';
            $revert   = 0;
            $status   = 0;
            $admin    = auth()->user();
            $role     = data_get($admin, 'user_role');
            $userId   = data_get($admin, 'id');
            $approve  = ApproveApplication::where(['application_id' => $this->appId, 'user_id' => $userId])->first();
            $isRevert = ApproveApplication::where(['application_id' => $this->appId, 'is_revert' => 1])->exists();

            if (!blank($approve)) {

                $isApproved = data_get($approve, 'is_approved');

                //approve both college
                if ($role == 2) {
                    $user = $this->approveCollege($approve);
                }

                if ($role == 3 && $isRevert) {
                    $status = 1;
                    $approve->applications->update(['status' => 2, 'sharok_no' => $this->sharok_no]);
                } else {
                    if ($role == 3 && !$isApproved) { // 1st admin pass to 2nd admin
                        $user = $this->getUserByRole(4); // 2nd admin
                    } elseif ($role == 4 && !$isApproved) { // 2nd admin pass to 1st admin
                        $revert = 1;
                        $status = 1;
                        //   $user   = $this->getUserByRole(3);
                    }
                }
                $this->bypassApplication($approve, data_get($user, 'id'), $revert, $status);
                $this->alert('success', 'Approved successfully');
            }
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
            $applications = ApproveApplication::whereIn('application_id', $this->multipleSelect)->where(['user_id' => $userId])->get();

            if (!blank($applications)) {

                foreach ($applications as $approve) {

                    $isApproved = data_get($approve, 'is_approved');
                    $isRevert   = ApproveApplication::where(['is_revert' => 1])->exists();

                    if ($role == 2) {
                        $user = $this->approveCollege($approve);
                    } elseif ($role == 3 && $isRevert && $isApproved) {
                        $status = 1;
                        $approve->applications->update(['status' => 2, 'sharok_no' => $this->sharok_no]);
                        $this->collegeSitAdjust($approve);
                    } else {
                        if ($role == 3 && !$isApproved) { // 1st admin pass to 2nd admin
                            $user = $this->getUserByRole(4); // 2nd admin
                        } else { // 2nd admin pass to 1st admin
                            $revert = 1;
                            $status = 1;
                            // $user   = $this->getUserByRole(3);
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


    protected function collegeSitAdjust($approve)
    {
        $isApproved  = data_get($approve, 'applications.status') == ApplicationStatus::APPROVED;
        $fromEiin    = data_get($approve, 'applications.from_college_eiin');
        $toEiin      = data_get($approve, 'applications.to_college_eiin');
        $fromCollege = CollegeDetails::where('eiin', $fromEiin)->first();
        $toCollege   = CollegeDetails::where('eiin', $toEiin)->first();

        if ($isApproved) {
            $fromCollege->increment('available_seats');
            $toCollege->decrement('available_seats');
        }
    }

    public function approveCollege($approve)
    {
        $admissionCol = data_get($approve, 'applications.to_college_eiin');
        $collegeUser  = '';

        if ($approve->is_parent) {
            //first college pass 2nd college
            $collegeUser = User::where('eiin_no', $admissionCol)->first();
        } else {  //2nd college pass to first admin
            $collegeUser = $this->getUserByRole(3); //1
            //sms send student
            $this->sendSms($approve);
        }
        return $collegeUser;
    }

    protected function getUserByRole($role)
    {
        return User::where('user_role', $role)->first();
    }

    protected function bypassApplication($approve, $userId, $revert = 0, $status = 1)
    {
        if ($userId) {
            $approve->create([
                'application_id' => data_get($approve, 'applications.id'),
                'parent_id'      => data_get($approve, 'id'),
                'user_id'        => $userId,
                'is_revert'      => $revert,
            ]);
        }
        $approve->update([
            'is_approved' => 1,
            'comment_id'  => $this->commentId,
            'approve_at'  => now()->toDateTimeString(),
            'is_revert'   => $revert,
            'status'      => $status
        ]);

        return $approve;
    }

    protected function sendSms($approve)
    {
        $phone   = data_get($approve, 'applications.student.phone');
        $message = "Both college approved your application now you can pay through sonali seba below link \nhttp://sonali-e-sheba.dinajpurboard.gov.bd";
        app(SmsService::class)->post($phone, $message);
    }
}
