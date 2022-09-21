<?php

namespace App\Http\Livewire;

use App\Models\InstInfo;
use App\Models\Subject;
use App\Service\StudentDetails;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Livewire\Component;

class StudentApplication extends Component
{

    public $sscRoll, $sscReg, $sscPassYear, $sscGpa, $sscBoard,
        $stdName, $stdPhone, $stdFatherName, $stdMotherName,
        $curCollegeEiin, $curCollegeName, $group, $class, $roll,
        $session, $curPostOffice, $curUpozilla, $curDistrict,
        $addColEiin, $addColCode, $addColName, $addColPost,
        $addColUpozila, $addColDistrict, $instituteId;

    public $subjects = [];

    protected $rules = [
        'sscRoll'        => 'required',
        'sscReg'         => 'required',
        'sscPassYear'    => 'required',
        'stdPhone'       => 'required',
        'sscGpa'         => 'required',
        'curCollegeEiin' => 'required',
        'curCollegeName' => 'required',
        'group' => 'required',
    ];

    protected $messages = [
        'curCollegeEiin.required' => 'Eiin is required',
        'curCollegeName.required' => 'The Email Address format is not valid.',
    ];

    public function render()
    {
        $subject = Subject::orderBy('subj_name')->whereNotIn('subj_code',[101,107,275])->get();
        return view('livewire.student-application', compact('subject'));
    }


    public function updatedCurCollegeEiin($value)
    {
        $institute            = InstInfo::where('eiin', $value)->first();
        $this->curCollegeName = data_get($institute, 'inst_Name', '');
    }

    public function updatedAddColEiin($value)
    {
        $institute        = InstInfo::where('eiin', $value)->first();
        $this->addColName = data_get($institute, 'inst_Name', '');
    }

    public function submit()
    {
        $this->validate();
    }


//==============================================================
    public function details()
    {

        $response = app(StudentDetails::class)->post($this->sscRoll, $this->sscPassYear);

        $this->stdName       = data_get($response, 'name');
        $this->stdFatherName = data_get($response, 'father_name');
        $this->stdMotherName = data_get($response, 'mother_name');
        $this->sscRoll       = data_get($response, 'roll_no');
        $this->sscReg        = data_get($response, 'reg_no');
        $this->sscPassYear   = data_get($response, 'pass_year');
        $this->sscBoard      = data_get($response, 'board');
        $this->sscGpa        = data_get($response, 'gpa');
    }


    public function prepareData()
    {
        $password             = Str::random(8) . 'db';
        $data ['student']     = [
            'name'        => $this->stdName,
            'father_name' => $this->stdFatherName,
            'mother_name' => $this->stdMotherName,
            'phone'       => $this->stdPhone,
            'username'    => $this->sscRoll . 'DB',
            'password'    => bcrypt($password),
            'pwd_hint'    => $password,
        ];
        $data ['academic']    = [
            'eiin_no'          => $this->curCollegeEiin,
            'college_name'     => $this->curCollegeName,
            'group'            => $this->group,
            'class'            => $this->class,
            'roll_no'          => $this->roll,
            'session'          => $this->session,
            'district'         => $this->curDistrict,
            'upazila'          => $this->curUpozilla,
            'post_office'      => $this->curPostOffice,
            'subjects'         => $this->subjects,
            'ssc_roll_no'      => $this->sscRoll,
            'ssc_reg_no'       => $this->sscReg,
            'ssc_passing_year' => $this->sscPassYear,
            'ssc_cgpa'         => $this->sscGpa,
            'ssc_bord'         => $this->sscBoard,
        ];
        $data ['application'] = [
            'eiin_no'      => $this->addColEiin,
            'college_code' => $this->addColCode,
            'college_name' => $this->addColName,
            'post_office'  => $this->addColPost,
            'upazila'      => $this->addColUpozila,
            'district'     => $this->addColDistrict,
            'applied_at'   => Carbon::now()->toDateTimeString(),
        ];

        return $data;
    }


}
