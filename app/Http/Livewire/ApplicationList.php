<?php

namespace App\Http\Livewire;

use App\Models\ApproveApplication;
use App\Models\Comment;
use App\Models\InstInfo;
use App\Models\User;
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

    public $isRevert;
    public $selectedStudents = [];


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
        $college    = auth()->guard('inst')->user();
        $admin      = auth()->guard('web')->user();
        $whereClaus = !blank($college) ? ['inst_id' => data_get($college, 'id')] : ['user_id' => data_get($admin, 'id')];

        $query = ApproveApplication::with('applications');

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
        return $query->where($whereClaus)->where('status', 1)->paginate(20);
    }

    public function updateStatus($id)
    {
        $approve        = ApproveApplication::find($id);
        $this->appId    = $id;
        $this->isRevert = data_get($approve, 'is_approved');
    }


    public function approved()
    {
        $this->validate([
            'commentId' => 'required',
        ]);

        DB::beginTransaction();
        try {
            $approve = ApproveApplication::find($this->appId);
            $college = auth()->guard('inst')->user();
            $admin   = auth()->guard('web')->user();

            //college approve
            if (!blank($college)) {
                if ($approve->is_parent) {
                    $inst = InstInfo::where('eiin_no', data_get($approve, 'applications.to_college_eiin'))->first();
                    $approve->update(['is_approved' => 1, 'comment_id' => $this->commentId]);
                    $this->approvedApp($approve, $inst->id, null, 0, 1);
                } else {
                    $user = User::where('role', 2)->first(); //1
                    $approve->update(['is_approved' => 1, 'comment_id' => $this->commentId]);
                    $this->approvedApp($approve, null, data_get($user, 'id'), 0, 1);
                }
            }

            //admin approve
            if (!blank($admin)) {
                $role   = data_get($admin, 'role');
                $status = 0;
                $revert = 0;
                if ($role == 2) {
                    $user = User::where('role', 3)->first(); // 2
                    $approve->update(['is_approved' => 1, 'comment_id' => $this->commentId, 'status' => $status]);
                } elseif ($role == 3) {
                    $user = User::where('role', 4)->first(); // 3
                    $approve->update(['is_approved' => 1, 'comment_id' => $this->commentId, 'status' => $status]);
                } elseif ($role == 4) {
                    $status = 1;
                    $revert = 1;
                    $user   = User::where('role', 3)->first(); //2 back
                    $approve->update(['is_approved' => 1, 'comment_id' => $this->commentId, 'status' => $status]);
                }
                $this->approvedApp($approve, null, data_get($user, 'id'), $revert, $status);
            }

            DB::commit();
        } catch (\Exception $e) {
            Log::error($e);
            DB::rollBack();
        }
    }


    public function approvedApp($approve, $instId, $userId, $revert, $status)
    {
        $approve->create([
            'application_id' => data_get($approve, 'applications.id'),
            'parent_id'      => data_get($approve, 'id'),
            'inst_id'        => $instId,
            'user_id'        => $userId,
            'is_revert'      => $revert,
            'status'         => $status,
            'approve_at'     => now()->toDateTimeString(),
        ]);
    }


    public function revertApproved()
    {
        $this->validate([
            'commentId' => 'required',
        ], ['commentId.required' => 'Comment is required']);

        DB::beginTransaction();
        try {
            $approve = ApproveApplication::find($this->appId);
            $admin   = auth()->guard('web')->user();

            if (!blank($admin)) {

                $role = data_get($admin, 'role');

                if ($role == 3) { // 2
                    $approve->update(['is_approved' => 1, 'comment_id' => $this->commentId, 'is_revert' => 1]);
                    $approve->create([
                        'application_id' => data_get($approve, 'applications.id'),
                        'parent_id'      => data_get($approve, 'id'),
                        'user_id'        => 2,
                        'approve_at'     => now()->toDateTimeString(),
                    ]);
                } elseif ($role == 2) { // 1
                    $approve->update(['is_approved' => 1, 'comment_id' => $this->commentId]);
                    $approve->update([
                        'is_approved' => 1,
                        'comment_id'  => $this->commentId,
                        'approve_at'  => now()->toDateTimeString(),
                    ]);
                    $approve->applications->update(['status' => 2, 'sharok_no' => $this->sharok_no,]);
                }
            }
            DB::commit();
        } catch (\Exception $e) {
            Log::error($e);
            DB::rollBack();
        }
    }
}
