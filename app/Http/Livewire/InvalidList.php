<?php

namespace App\Http\Livewire;

use App\Models\Application;
use Livewire\Component;
use Livewire\WithPagination;

class InvalidList extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    protected $queryString = ['search'];
    public $search, $details, $status;

    public function render()
    {

        return view('livewire.invalid-list', [
            'items' => Application::where(function ($query)
            {
                $query->where('sonali_sheba_no', 'like', '%'.$this->search.'%')
                    ->orWhereHas('student', function ($q) {
                        $q->where('name', 'like', '%' . $this->search . '%')
                            ->orWhere('father_name', 'like', '%' . $this->search . '%')
                            ->orWhere('mother_name', 'like', '%' . $this->search . '%')
                            ->orWhere('eiin_no', 'like', '%' . $this->search . '%')
                            ->orWhere('center_code', 'like', '%' . $this->search . '%')
                            ->orWhere('phone', 'like', '%' . $this->search . '%');
                    })
                    ->orWhereHas('exams', function ($q)
                    {
                        $q->where('roll_no', 'like', '%'.$this->search.'%')
                            ->orWhere('reg_no', 'like', '%'.$this->search.'%');
                    });
            })->invalid()->with('exams')->latest()->paginate(20),
        ]);

    }

    public function show($id)
    {
        $this->details = Application::find($id);
    }
}
