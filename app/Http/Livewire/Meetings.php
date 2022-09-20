<?php

namespace App\Http\Livewire;

use App\Exports\MeetingDataExport;
use App\Models\Application;
use App\Service\ExportDataService;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class Meetings extends Component
{

    use WithPagination;

    protected $paginationTheme  = 'bootstrap';
    protected $queryString      = ['search'];
    public    $updateMode       = false;
    public    $search, $details, $status, $appId;
    public    $selectedStudents = [];

    public function render()
    {
        return view('livewire.meetings', [
            'items' => Application::with('exams')->where(function ($query) {
                $query->where('sonali_sheba_no', 'like', '%' . $this->search . '%')
                    ->orWhereHas('student', function ($q) {
                        $q->where('name', 'like', '%' . $this->search . '%')
                            ->orWhere('father_name', 'like', '%' . $this->search . '%')
                            ->orWhere('mother_name', 'like', '%' . $this->search . '%')
                            ->orWhere('eiin_no', 'like', '%' . $this->search . '%')
                            ->orWhere('center_code', 'like', '%' . $this->search . '%')
                            ->orWhere('phone', 'like', '%' . $this->search . '%');
                    })
                    ->orWhereHas('exams', function ($q) {
                        $q->where('roll_no', 'like', '%' . $this->search . '%')
                            ->orWhere('reg_no', 'like', '%' . $this->search . '%');
                    });
            })->meeting()->latest()->paginate(20),
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
            'status' => 'required',
        ]);

        if ($this->appId) {
            $item = Application::find($this->appId);
            $item->update(['applied_status' => $this->status]);
            $this->updateMode = false;
            $this->resetInputFields();
        }
    }

    private function resetInputFields()
    {
        $this->status = '';
    }

    public function bulkUpdate()
    {
        $this->validate([
            'status' => 'required',
        ]);

        $applications = Application::whereIn('id', $this->selectedStudents)->get();

        if (!blank($applications)) {
            foreach ($applications as $item) {
                $application = Application::find($item->id);
                $application->update([
                    'prev_status' => $item->status,
                    'status'      => $this->status,
                ]);
            }
            $this->selectedStudents = [];
        }
    }

    public function export()
    {
        $fileName = now()->toDateString() . '_' . 'meeting.xlsx';
        $data     = resolve(ExportDataService::class)->queryMeetingData($this->search);
        return Excel::download(new MeetingDataExport($data), $fileName);
    }

}
