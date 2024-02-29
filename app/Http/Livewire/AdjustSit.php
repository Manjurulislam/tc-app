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

    public $search, $details, $collegeId, $availableSeats;

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


    public function getItem(CollegeDetails $details)
    {
        $this->collegeId      = data_get($details, 'id');
        $this->availableSeats = data_get($details, 'available_seats');
        $this->details        = $details;
    }

    public function update()
    {
        $details = CollegeDetails::find($this->collegeId);
        $details->fill(['available_seats' => $this->availableSeats])->save();
    }
}
