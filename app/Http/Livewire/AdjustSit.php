<?php

namespace App\Http\Livewire;

use App\Models\CollegeDetails;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Component;
use Livewire\WithPagination;

class AdjustSit extends Component
{

    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    protected $queryString     = ['search'];

    public $search;

    public function render()
    {
        return view('livewire.adjust-sit', ['items' => $this->colleges()]);
    }


    public function colleges(): LengthAwarePaginator
    {
        $query = CollegeDetails::query();

        if ($this->search) {
            $query->where(function ($query) {
                $query->where('college_name', 'like', '%' . $this->search . '%')
                    ->orWhere('eiin', 'like', '%' . $this->search . '%')
                    ->orWhere('group_name', 'like', '%' . $this->search . '%')
                    ->orWhere('version', 'like', '%' . $this->search . '%');
            });
        }
        return $query->paginate(30);
    }
}
