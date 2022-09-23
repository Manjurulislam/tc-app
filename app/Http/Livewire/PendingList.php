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
        return view('livewire.pending-list', [
            'items' => Application::where(function ($query) {
                $query->where('sonali_sheba_no', 'like', '%' . $this->search . '%')
                    ->orWhereHas('student', function ($q) {
                        $q->where('name', 'like', '%' . $this->search . '%')
                            ->orWhere('father_name', 'like', '%' . $this->search . '%')
                            ->orWhere('mother_name', 'like', '%' . $this->search . '%')
                            ->orWhere('phone', 'like', '%' . $this->search . '%');
                    });
            })->pending()->latest()->paginate(20),
        ]);
    }


    public function edit($id)
    {
        $this->updateMode = true;
        $item             = Application::find($id);
        $this->appId      = $id;
        $this->status     = $item->status;
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
            'status'      => 'required',
            'meetingNo'   => 'required_if:status,3',
            'meetingDate' => 'required_if:status,3',
        ]);


        $meetingData = $this->meetingDate ? Carbon::parse($this->meetingDate)->format('Y-m-d h:i:s') : null;

        $item = Application::find($this->appId);
        $item->update([
            'prev_status'  => $item->status,
            'status'       => $this->status,
            'meeting_no'   => $this->meetingNo,
            'meeting_date' => $meetingData
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
            'status'      => 'required',
            'meetingNo'   => 'required_if:status,3',
            'meetingDate' => 'required_if:status,3',
        ]);

        $meetingData  = $this->meetingDate ? Carbon::parse($this->meetingDate)->format('Y-m-d h:i:s') : null;
        $applications = Application::whereIn('id', $this->selectedStudents)->get();

        if (!blank($applications)) {
            foreach ($applications as $item) {
                $application = Application::find($item->id);
                $application->update([
                    'prev_status'  => $item->status,
                    'status'       => $this->status,
                    'meeting_no'   => $this->meetingNo,
                    'meeting_date' => $meetingData
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
