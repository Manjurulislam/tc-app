<?php

namespace App\Http\Livewire;

use App\Exports\ApproveDataExport;
use App\Models\Application;
use App\Service\ExportDataService;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class ApproveList extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    protected $queryString     = ['search'];
    public    $search, $details, $status;

    public function render()
    {
        return view('livewire.approve-list', [
            'items' => Application::where(function ($query) {
                $query->where('eiin_no', 'like', '%' . $this->search . '%')
                    ->where('college_code', 'like', '%' . $this->search . '%')
                    ->where('college_name', 'like', '%' . $this->search . '%')
                    ->orWhereHas('student', function ($q) {
                        $q->where('name', 'like', '%' . $this->search . '%')
                            ->orWhere('father_name', 'like', '%' . $this->search . '%')
                            ->orWhere('mother_name', 'like', '%' . $this->search . '%')
                            ->orWhere('phone', 'like', '%' . $this->search . '%');
                    });
            })->approve()->latest()->paginate(20),
        ]);
    }

    public function show($id)
    {
        $this->details = Application::find($id);
    }


    public function export()
    {
        $fileName = now()->toDateString() . '_' . 'approve.xlsx';
        $data     = resolve(ExportDataService::class)->queryApproveData($this->search);
        return Excel::download(new ApproveDataExport($data), $fileName);
    }
}
