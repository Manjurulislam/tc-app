<?php

namespace App\Http\Livewire;

use App\Models\ApproveApplication;
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
    public    $search, $details, $status, $comments, $sharok_no, $appId;

    public $selectedStudents = [];


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
                    $nextInst  = InstInfo::where('eiin', $toCollege)->first();
                    $approve->update(['is_approved' => 1, 'comments' => $this->comments]);
                    $approve->create([
                        'application_id' => data_get($approve, 'applications.id'),
                        'parent_inst_id' => data_get($approve, 'inst_id'),
                        'inst_id'        => data_get($nextInst, 'id'),
                    ]);
                } else {
                    $user = User::where('role', 2)->first();
                    $approve->update(['is_approved' => 1, 'comments' => $this->comments]);
                    $approve->create([
                        'application_id' => data_get($approve, 'applications.id'),
                        'parent_inst_id' => data_get($approve, 'inst_id'),
                        'user_id'        => data_get($user, 'id'),
                    ]);
                }
            }


            if (!blank($admin)) {
                $role = data_get($admin, 'role');

                if ($role == 2) {
                    $approve->update(['is_approved' => 1, 'comments' => $this->comments]);
                    $approve->create([
                        'application_id' => data_get($approve, 'applications.id'),
                        'parent_user_id' => data_get($admin, 'id'),
                        'user_id'        => 3,
                    ]);
                } elseif ($role == 3) {
                    $approve->update(['is_approved' => 1, 'comments' => $this->comments]);
                    $approve->create([
                        'application_id' => data_get($approve, 'applications.id'),
                        'parent_user_id' => data_get($admin, 'id'),
                        'user_id'        => 4,
                    ]);
                } else {
                    $approve->update(['is_approved' => 1, 'comments' => $this->comments, 'sharok_no' => $this->sharok_no]);
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
