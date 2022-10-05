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
        return $query->where($whereClaus)->paginate(20);
    }

    public function updateStatus($id)
    {
        $this->appId = $id;
    }


    public function approved()
    {
        $this->validate([
            'comments' => 'required',
        ]);

        DB::beginTransaction();
        try {
            $approve = ApproveApplication::find($this->appId);
            $college = auth()->guard('inst')->user();
            $admin   = auth()->guard('web')->user();

            if (!blank($college)) {

                if ($approve->is_parent) {
                    $toCollege = data_get($approve, 'applications.to_college_eiin');
                    $nextInst  = InstInfo::where('eiin_no', $toCollege)->first();
                    $approve->update(['is_approved' => 1, 'comment_id' => $this->commentId]);
                    $approve->create([
                        'application_id' => data_get($approve, 'applications.id'),
                        'parent_id'      => data_get($approve, 'id'),
                        'inst_id'        => data_get($nextInst, 'id'),
                        'approve_at'     => now()->toDateTimeString(),
                    ]);
                } else {
                    $user = User::where('role', 2)->first();
                    $approve->update(['is_approved' => 1, 'comment_id' => $this->commentId]);
                    $approve->create([
                        'application_id' => data_get($approve, 'applications.id'),
                        'parent_id'      => data_get($approve, 'id'),
                        'user_id'        => data_get($user, 'id'),
                        'approve_at'     => now()->toDateTimeString(),
                    ]);
                }
            }


            if (!blank($admin)) {
                $role = data_get($admin, 'role');

                if ($role == 2) {
                    $approve->update(['is_approved' => 1, 'comment_id' => $this->commentId]);
                    $approve->create([
                        'application_id' => data_get($approve, 'applications.id'),
                        'parent_id'      => data_get($approve, 'id'),
                        'user_id'        => 3,
                        'approve_at'     => now()->toDateTimeString(),
                    ]);
                } elseif ($role == 3) {
                    $approve->update(['is_approved' => 1, 'comment_id' => $this->commentId]);
                    $approve->create([
                        'application_id' => data_get($approve, 'applications.id'),
                        'parent_id'      => data_get($approve, 'id'),
                        'user_id'        => 4,
                        'approve_at'     => now()->toDateTimeString(),
                    ]);
                } else {
                    $approve->update([
                        'is_approved' => 1,
                        'comment_id'    => $this->commentId,
                        'sharok_no'   => $this->sharok_no,
                        'approve_at'  => now()->toDateTimeString(),
                    ]);
                    $approve->applications->update(['status' => 2]);
                }
            }

            DB::commit();
        } catch (\Exception $e) {
            Log::error($e);
            DB::rollBack();
        }
    }

}
