<?php

namespace App\Http\Livewire;

use App\Models\Detail;
use App\Models\InstInfo;
use App\Models\Student;
use App\Models\Subject;
use App\Service\StudentDetails;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Livewire\Component;

class StudentApplication extends Component
{

    public $sscRoll, $sscReg, $sscPassYear, $sscGpa, $sscBoard,
        $stdName, $phone, $stdFatherName, $stdMotherName,
        $curCollegeEiin, $curCollegeName, $group, $class, $roll,
        $session, $curPostOffice, $curUpozilla, $curDistrict,
        $addColEiin, $addColCode, $addColName, $addColPost,
        $addColUpozila, $addColDistrict, $instituteId;

    public    $subjects    = '';
    public    $subjectsArr = [];
    public    $hasSit      = false;
    public    $setSubjects = false;
    public    $showDiv     = false;
    protected $rules       = [
        'sscRoll'        => 'required|numeric',
        'sscReg'         => 'required|numeric',
        'sscPassYear'    => 'required|min:4',
        'phone'          => 'required|regex:/(01)[0-9]{9}/|unique:students',
        'curCollegeEiin' => 'required|numeric',
        'curPostOffice'  => 'required',
        'curUpozilla'    => 'required',
        'curDistrict'    => 'required',
        'group'          => 'required',
        'class'          => 'required',
        'roll'           => 'required|numeric',
        'session'        => 'required',
        'addColEiin'     => 'required|numeric',
        'addColCode'     => 'required|numeric',
        'addColPost'     => 'required',
        'addColUpozila'  => 'required',
        'addColDistrict' => 'required',
        'subjects'       => 'required',
    ];
    protected $messages    = [
        'phone.required'          => 'Mobile number is required',
        'curCollegeEiin.required' => 'Eiin is required',
        'addColEiin.required'     => 'Eiin is required',
        'addColCode.required'     => 'College code is required',
        'curPostOffice.required'  => 'Post office is required',
        'curUpozilla.required'    => 'Upozila is required',
        'curDistrict.required'    => 'District is required',
        'addColPost.required'     => 'Post office is required',
        'addColUpozila.required'  => 'Upozila is required',
        'addColDistrict.required' => 'District is required',
    ];

    public function hydrate()
    {
        $this->emit('select2Hydrate');
    }

    public function render()
    {
        $this->subjectsArr = Subject::orderBy('subj_name')->whereNotIn('subj_code', [101, 107, 275])->get();
        return view('livewire.student-application');
    }

    public function updatedCurCollegeEiin($value)
    {
        $institute            = InstInfo::where('eiin', $value)->first();
        $this->curCollegeName = data_get($institute, 'inst_Name', '');
    }

    public function updatedAddColEiin($value)
    {
        if ($this->addColEiin && $this->group) {
            $institute         = Detail::where('eiin', $value)->first();
            $this->addColName  = data_get($institute, 'college_name', '');
            $this->instituteId = data_get($institute, 'id', '');
            $clauos            = ['eiin' => $value, 'group_name' => $this->group];
            $availableSit      = Detail::where($clauos)->whereRaw('available_seats < total_seats')->exists();
            $this->setSubjects = $availableSit;
            $this->showDiv     = $availableSit;
            $this->hasSit      = !$availableSit;
        }
    }


    /**
     * @throws \Throwable
     */
    public function submit()
    {
        $this->validate();

        DB::beginTransaction();
        try {
            [$studentData, $academicInfo, $application] = $this->prepareData();
            $student = Student::create($studentData);
            $student->academicInfo()->create($academicInfo);
            $student->application()->create($application);
            DB::commit();
            session()->flash('success', 'Application received Successfully.');
        } catch (\Throwable $e) {
            Log::error('application save', [$e]);
            DB::rollBack();
            session()->flash('error', 'Server too many busy, Please try again');
        }
    }

//======================== ssc data from api ======================================
    public function details()
    {
        if ($this->sscRoll && $this->sscPassYear) {
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
    }

    public function prepareData(): array
    {
        $addSubject = [101, 102, 107, 108, 275];
        $subjectIDs = array_map('intval', json_decode(json_encode($this->subjects)));
        $subjects   = array_merge($subjectIDs, $addSubject);
        $password   = Str::random(8) . 'db';

        $student      = [
            'name'        => $this->stdName,
            'father_name' => $this->stdFatherName,
            'mother_name' => $this->stdMotherName,
            'phone'       => $this->phone,
            'username'    => $this->sscRoll . 'DB',
            'password'    => bcrypt($password),
            'pwd_hint'    => $password,
        ];
        $academicInfo = [
            'eiin_no'          => $this->curCollegeEiin,
            'college_name'     => $this->curCollegeName,
            'group'            => $this->group,
            'class'            => $this->class,
            'roll_no'          => $this->roll,
            'session'          => $this->session,
            'post_office'      => $this->curPostOffice,
            'upazila'          => $this->curUpozilla,
            'district'         => $this->curDistrict,
            'subjects'         => $subjects,
            'ssc_roll_no'      => $this->sscRoll,
            'ssc_reg_no'       => $this->sscReg,
            'ssc_passing_year' => $this->sscPassYear,
            'ssc_cgpa'         => $this->sscGpa,
            'ssc_bord'         => $this->sscBoard,
        ];
        $application  = [
            'eiin_no'      => $this->addColEiin,
            'detail_id'    => $this->instituteId,
            'college_code' => $this->addColCode,
            'college_name' => $this->addColName,
            'post_office'  => $this->addColPost,
            'upazila'      => $this->addColUpozila,
            'district'     => $this->addColDistrict,
            'applied_at'   => Carbon::now()->toDateTimeString(),
        ];
        return [$student, $academicInfo, $application];
    }
}
