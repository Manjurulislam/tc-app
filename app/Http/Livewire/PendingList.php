<?php

namespace App\Http\Livewire;

use App\Exports\PendingDataExport;
use App\Models\Application;
use App\Service\ExportDataService;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class PendingList extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    protected $queryString     = ['search'];
    public    $updateMode      = false;
    public    $search, $details, $status, $appId, $meetingNo, $meetingDate;

    public $selectedStudents = [];


    public function render()
    {
        $data = ['items' => Application::where(function ($query) {
            $query->where('sonali_sheba_no', 'like', '%' . $this->search . '%')
                ->orWhereHas('student', function ($q) {
                    $q->where('name', 'like', '%' . $this->search . '%')
                        ->orWhere('father_name', 'like', '%' . $this->search . '%')
                        ->orWhere('mother_name', 'like', '%' . $this->search . '%')
                        ->orWhere('phone', 'like', '%' . $this->search . '%');
                });
        })->pending()->latest()->paginate(20)];

        return view('livewire.pending-list', $data);
    }

    public function show($id)
    {
        $this->details = Application::find($id);
    }

    public function cancel()
    {
        $this->updateMode = false;
        $this->resetInputFields();
    }

    public function update()
    {
        $this->validate([
            'status' => 'required',
        ]);

        $item = Application::find($this->appId);
        $item->update([
            'status' => $this->status
        ]);
        $this->updateMode = false;
        $this->resetInputFields();
    }

    private function resetInputFields()
    {
        $this->status = '';
    }

    public function bulkUpdate()
    {
        $this->validate([
            'status' => 'required'
        ]);

        $applications = Application::whereIn('id', $this->selectedStudents)->get();

        if (!blank($applications)) {
            foreach ($applications as $item) {
                $application = Application::find($item->id);
                $application->update([
                    'status' => $this->status,
                ]);
            }
            $this->selectedStudents = [];
        }
    }


    public function export()
    {
        $fileName = now()->toDateString() . '_' . 'pending.xlsx';
        $data     = resolve(ExportDataService::class)->queryPendingData($this->search);
        return Excel::download(new PendingDataExport($data), $fileName);
    }

}
