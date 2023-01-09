<?php

namespace App\Http\Livewire;

use App\Exports\ApproveDataExport;
use App\Models\Application;
use App\Models\ApproveApplication;
use App\Service\DataService;
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
        return view('livewire.approve-list', ['items' => $this->approved()]);
    }

    public function approved()
    {
        $query = Application::approve();

        if ($this->search) {
            $query->where(function ($query) {
                $query->whereHas('student', function ($q) {
                    $q->where('name', 'like', '%' . $this->search . '%')
                        ->orWhere('father_name', 'like', '%' . $this->search . '%')
                        ->orWhere('phone', 'like', '%' . $this->search . '%');
                });
            });
        }
        $data = $query->paginate(20);
        return app(DataService::class)->transformApproveList($data);
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
