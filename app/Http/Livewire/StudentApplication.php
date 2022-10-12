<?php

namespace App\Http\Livewire;

use App\Models\CollegeDetails;
use App\Models\Student;
use App\Models\User;
use App\Service\StudentDetails;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Livewire\Component;


class StudentApplication extends Component
{

    public $ssc_roll_no, $sscReg, $sscPassYear, $sscGpa, $sscBoard,
        $stdName, $phone, $stdFatherName, $stdMotherName,
        $curCollegeEiin, $curCollegeName, $group, $class, $roll,
        $session, $curPostOffice, $curUpozilla, $curDistrict,
        $addColEiin, $addColCode, $addColName, $addColPost,
        $addColUpozila, $addColDistrict, $instituteId,
        $subjects, $subject_elec, $subject_optn;

    public $hasSit  = false;
    public $showDiv = false;

    protected $rules    = [
        'ssc_roll_no'    => 'required|numeric|unique:academic_infos',
        'sscReg'         => 'required|numeric',
        'sscPassYear'    => 'required|min:4',
        'phone'          => 'required|regex:/(01)[0-9]{9}/|unique:students',
        'curCollegeEiin' => 'required|numeric',
        'group'          => 'required',
        'class'          => 'required',
        'roll'           => 'required|numeric',
        'session'        => 'required',
        'addColEiin'     => 'required|numeric',
        'addColCode'     => 'required|numeric',
        'addColPost'     => 'required',
    ];
    protected $messages = [
        'curCollegeEiin.required' => 'Eiin is required',
        'addColEiin.required'     => 'Eiin is required',
        'addColCode.required'     => 'College code is required',
        'addColPost.required'     => 'Post office is required',
    ];

//    public function hydrate()
//    {
//        $this->emit('select2Hydrate');
//    }

    public function render()
    {
        return view('livewire.student-application');
    }

    public function updatedCurCollegeEiin($value)
    {
        if ($this->ssc_roll_no && $this->sscReg) {
            $institute            = User::where('eiin_no', $value)->first();
            $thana                = DB::table('thanas')->where('code', data_get($institute, 'thana'))->first();
            $this->instituteId    = data_get($institute, 'id');
            $this->curCollegeName = data_get($institute, 'inst_name');
            $this->curPostOffice  = data_get($institute, 'thana');
            $this->curUpozilla    = data_get($thana, 'name');
            $this->curDistrict    = data_get($institute, 'zilla');
        }
    }

    public function updatedAddColEiin($value)
    {
        if ($this->addColEiin && $this->group && $this->ssc_roll_no && $this->sscReg) {
            $institute            = CollegeDetails::where('eiin', $value)->first();
            $this->addColName     = data_get($institute, 'college_name', '');
            $this->addColUpozila  = data_get($institute, 'thana');
            $this->addColDistrict = data_get($institute, 'district');
            $this->showDiv        = $this->isSeatAvailable();
            $this->hasSit         = !$this->isSeatAvailable();
            $this->subjects();
        }
    }


    public function subjects()
    {
        if ($this->ssc_roll_no && $this->sscReg) {
            $clause             = ['stu_ssc_roll' => $this->ssc_roll_no, 'stu_ssc_regi' => $this->sscReg];
            $query              = DB::table('hsc_registration')->where($clause)->first();
            $this->subjects     = data_get($query, 'sub_comp');
            $this->subject_elec = data_get($query, 'sub_elec');
            $this->subject_optn = data_get($query, 'sub_optn');
        }
    }

    public function isSeatAvailable()
    {
        $clause = ['eiin' => $this->addColEiin, 'group_name' => $this->group];
        return CollegeDetails::where($clause)->where('min_gpa', '<=', $this->sscGpa)
            ->whereRaw('available_seats < total_seats')->exists();
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
            $application = $student->application()->create($application);
            $application->approves()->create([
                'user_id'   => $this->instituteId,
                'is_parent' => 1,
            ]);
            DB::commit();
            session()->flash('success', 'Application received Successfully.');
        } catch (\Throwable $e) {
            Log::error('application save', [$e->getMessage()]);
            DB::rollBack();
            session()->flash('error', 'Server too many busy, Please try again');
        }
    }

//======================== ssc data from api ======================================
    public function details()
    {
        if ($this->ssc_roll_no && $this->sscPassYear) {
            $response = app(StudentDetails::class)->post($this->ssc_roll_no, $this->sscPassYear);

            $this->stdName       = data_get($response, 'name');
            $this->stdFatherName = data_get($response, 'father_name');
            $this->stdMotherName = data_get($response, 'mother_name');
            $this->ssc_roll_no   = data_get($response, 'roll_no');
            $this->sscReg        = data_get($response, 'reg_no');
            $this->sscPassYear   = data_get($response, 'pass_year');
            $this->sscBoard      = data_get($response, 'board');
            $this->sscGpa        = data_get($response, 'gpa');
        }
    }

    public function prepareData(): array
    {
        $password = Str::random(8) . 'db';
        $username = $this->ssc_roll_no . 'DB';

        $student      = [
            'name'        => $this->stdName,
            'father_name' => $this->stdFatherName,
            'mother_name' => $this->stdMotherName,
            'phone'       => $this->phone,
            'username'    => $username,
            'password'    => bcrypt($password),
            'pwd_hint'    => $password,
        ];
        $academicInfo = [
            'eiin_no'       => $this->curCollegeEiin,
            'college_name'  => $this->curCollegeName,
            'group'         => $this->group,
            'class'         => $this->class,
            'roll_no'       => $this->roll,
            'session'       => $this->session,
            'post_office'   => $this->curPostOffice,
            'upazila'       => $this->curUpozilla,
            'district'      => $this->curDistrict,
            'subject_comp'  => $this->subjects,
            'subject_elec'  => $this->subject_elec,
            'subject_optn'  => $this->subject_optn,
            'ssc_roll_no'   => $this->ssc_roll_no,
            'ssc_reg_no'    => $this->sscReg,
            'ssc_pass_year' => $this->sscPassYear,
            'ssc_cgpa'      => $this->sscGpa,
            'ssc_bord'      => $this->sscBoard,
        ];
        $application  = [
            'from_college_eiin' => $this->curCollegeEiin,
            'to_college_eiin'   => $this->addColEiin,
            'college_code'      => $this->addColCode,
            'college_name'      => $this->addColName,
            'post_office'       => $this->addColPost,
            'upazila'           => $this->addColUpozila,
            'district'          => $this->addColDistrict,
            'applied_at'        => Carbon::now()->toDateTimeString(),
        ];
        return [$student, $academicInfo, $application];
    }
}
