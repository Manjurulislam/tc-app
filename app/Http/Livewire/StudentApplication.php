<?php

namespace App\Http\Livewire;

use Livewire\Component;

class StudentApplication extends Component
{

    public $stdName, $stdPhone, $stdFatherName, $stdMotherName,
        $curCollegeEiin, $curCollegeName, $curPostOffice, $curUpozilla,
        $curDivision, $curDistrict, $curClass, $curRollNo, $curSession;

    public function render()
    {
        return view('livewire.student-application');
    }


    public function submit()
    {

    }

    public function prepareData()
    {
        $data ['student'] = [
            'name'        => $this->stdName,
            'father_name' => $this->stdFatherName,
            'mother_name' => $this->stdMotherName,
            'phone'       => $this->stdPhone,
        ];

        $data ['academic'] = [
            'name'        => $this->curCollegeName,
            'father_name' => $this->stdFatherName,
            'mother_name' => $this->stdMotherName,
            'phone'       => $this->stdPhone,
        ];
    }
}
