<?php

namespace App\Http\Livewire;

use App\Models\Application;
use App\Models\ApproveApplication;
use App\Models\Comment;
use App\Models\InstInfo;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithPagination;

class ApplicationList extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    protected $queryString     = ['search'];
    public    $search, $details, $status, $comments, $sharok_no, $appId, $commentId;

    public $isRevert, $detailsItems;
    public            $selectedStudents = [];


    public function mount()
    {
        $this->comments = Comment::latest()->get();
    }


    public function render()
    {
        return view('livewire.application-list', ['items' => $this->applications()]);
    }


    public function applications()
    {
        $admin      = auth()->guard('web')->user();
        $whereClaus = ['user_id' => data_get($admin, 'id')];
        $query      = ApproveApplication::with('applications');

        if ($this->search) {
            $query->where(function ($query) {
                $query->whereHas('applications', function ($q) {
                    $q->where('from_college_eiin', 'like', '%' . $this->search . '%')
                        ->orWhere('to_college_eiin', 'like', '%' . $this->search . '%')
                        ->orWhereHas('student', function ($q) {
                            $q->where('name', 'like', '%' . $this->search . '%')
                                ->orWhere('father_name', 'like', '%' . $this->search . '%')
                                ->orWhere('mother_name', 'like', '%' . $this->search . '%')
                                ->orWhere('phone', 'like', '%' . $this->search . '%');
                        });
                });
            });
        }
        $data = $query->where($whereClaus)->active()->paginate(20);
        return $this->transformApplications($data);
    }


    public function transformApplications($applications)
    {
        $applications->getCollection()->transform(function ($item) {
            $appStatus               = data_get($item, 'applications.status');
            $item->id                = data_get($item, 'id');
            $item->application_id    = data_get($item, 'application_id');
            $item->name              = data_get($item, 'applications.student.name');
            $item->father_name       = data_get($item, 'applications.student.father_name');
            $item->mother_name       = data_get($item, 'applications.student.mother_name');
            $item->phone             = data_get($item, 'applications.student.phone');
            $item->current_college   = data_get($item, 'applications.student.academicInfo.college_name') . '-' . (data_get($item, 'applications.student.academicInfo.eiin_no'));
            $item->admission_college = data_get($item, 'applications.college_name') . '-' . data_get($item, 'applications.to_college_eiin', '');
            $item->ssc_roll_no       = data_get($item, 'applications.student.academicInfo.ssc_roll_no', '');
            $item->ssc_reg_no        = data_get($item, 'applications.student.academicInfo.ssc_reg_no', '');
            $item->subject_comp      = data_get($item, 'applications.student.academicInfo.subject_comp', '');
            $item->subject_elec      = data_get($item, 'applications.student.academicInfo.subject_elec', '');
            $item->subject_optn      = data_get($item, 'applications.student.academicInfo.subject_optn', '');
            $item->sharok_no         = data_get($item, 'applications.sharok_no', '');
            $item->approved          = data_get($item, 'is_approved', '');
            $item->status            = Application::$status[$appStatus];
            return $item;
        });
        return $applications;
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

            $user    = '';
            $revert  = 0;
            $status  = 0;
            $approve = ApproveApplication::find($this->appId);
            $eiinNo  = data_get($approve, 'applications.to_college_eiin');
            $admin   = auth()->user();
            $role    = data_get($admin, 'user_role');


            if (!$approve->is_revert) {
                // college approve
                if ($approve->is_parent && $role == 2) { //first college pass 2nd college
                    $user = User::where('eiin_no', $eiinNo)->first();
                } else { //2nd college pass to first admin
                    $user = $this->getUserByRole(3); //1
                }

                // admin approve process
                if ($role == 3) { // 1st admin pass to 2nd admin
                    $user = $this->getUserByRole(4); // 2nd admin
                } elseif ($role == 4) { // 2nd admin pass to 3d admin
                    $user = $this->getUserByRole(5); // 3rd admin
                } elseif ($role == 5) { // 3d admin revert again to 2nd admin
                    $revert = 1;
                    $status = 1;
                    $user   = $this->getUserByRole(4); //back 2nd admin
                }

            } else {
                $revert = 1;
                $status = 1;

                if ($role == 4) {
                    $user = $this->getUserByRole(3);
                } elseif ($role == 3) {
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

    public function bypassApplication($approve, $userId, $revert = 0, $status = 1)
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

    public function getUserByRole($role)
    {
        return User::where('user_role', $role)->first();
    }

}
