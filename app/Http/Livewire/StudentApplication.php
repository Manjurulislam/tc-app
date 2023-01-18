<?php

namespace App\Http\Livewire;

use App\Models\Application;
use App\Models\CollegeDetails;
use App\Models\Student;
use App\Models\User;
use App\Service\SmsService;
use App\Service\StudentDetails;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;


class StudentApplication extends Component
{
    use WithFileUploads;

    public $ssc_roll_no, $sscReg, $sscPassYear, $sscGpa, $sscBoard,
        $stdName, $phone, $stdFatherName, $stdMotherName,
        $curCollegeEiin, $curCollegeName, $group, $class, $roll,
        $session, $curPostOffice, $curUpozilla, $curDistrict,
        $addColEiin, $addColCode, $addColName, $addColPost,
        $addColUpozila, $addColDistrict, $instituteId,
        $subjects, $subject_elec, $subject_optn, $attachment;

    public $hasSit  = false;
    public $showDiv = false;

    protected $rules    = [
        'attachment'     => 'required|mimes:png,jpg,jpeg,pdf|max:2048',
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
        'attachment.required'     => 'Marksheet is required',
        'attachment.mimes'        => 'Marksheet format is png,jpg,jpeg,pdf',
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

    /**
     * @throws \Throwable
     */
    public function submit()
    {
        $this->validate();
        DB::beginTransaction();
        try {
            if ($this->isSeatAvailable()) {
                [$studentData, $academicInfo, $application] = $this->prepareData();
                $student = Student::create($studentData);
                $student->academicInfo()->create($academicInfo);
                $application = $student->application()->create($application);
                $application->approves()->create([
                    'user_id'   => $this->instituteId,
                    'is_parent' => 1,
                ]);
                $this->sendSms($student);
                DB::commit();
                session()->flash('success', 'Application received Successfully.');
            } else {
                session()->flash('error', 'SEAT NOT AVAILABLE');
            }
        } catch (\Throwable $e) {
            Log::error('application save', [$e->getMessage()]);
            DB::rollBack();
            session()->flash('error', 'Server too many busy, Please try again');
        }
    }

//======================== prepare data ======================================

    protected function prepareData(): array
    {
        $fileName  = Str::random(4) . '_' . $this->attachment->getClientOriginalName();
        $marksheet = $this->attachment->storeAs('marksheet', $fileName, 'public');
        $password  = Str::random(8) . 'db';
        $username  = $this->ssc_roll_no . 'DB';

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
            'attachment'    => !blank($marksheet) ? $marksheet : null,
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


//==================================================================
    public function details()
    {
        if ($this->ssc_roll_no && $this->sscPassYear) {
            $response            = app(StudentDetails::class)->post($this->ssc_roll_no, $this->sscPassYear);
            $this->stdName       = data_get($response, 'name');
            $this->stdFatherName = data_get($response, 'father_name');
            $this->stdMotherName = data_get($response, 'mother_name');
            $this->ssc_roll_no   = data_get($response, 'roll_no');
            $this->sscReg        = data_get($response, 'reg_no');
            $this->sscPassYear   = data_get($response, 'pass_year');
            $this->sscBoard      = data_get($response, 'board');
            $this->sscGpa        = data_get($response, 'gpa');

            if ($this->stdName) {
                $this->currentCollege();
            }
        }
    }


    protected function currentCollege()
    {
        $clauseArr            = ['stu_ssc_roll' => $this->ssc_roll_no, 'stu_ssc_regi' => $this->sscReg];
        $query                = DB::table('hsc_registration')->where($clauseArr)->first();
        $institute            = User::where('eiin_no', data_get($query, 'eiin'))->first();
        $thana                = DB::table('thanas')->where('code', data_get($institute, 'thana'))->first();
        $this->instituteId    = data_get($institute, 'id');
        $this->curCollegeEiin = data_get($institute, 'eiin_no');
        $this->curCollegeName = data_get($institute, 'inst_name');
        $this->curPostOffice  = data_get($institute, 'thana');
        $this->curUpozilla    = data_get($thana, 'name');
        $this->curDistrict    = data_get($institute, 'zilla');
        $this->group          = data_get($query, 'stu_img_url');
    }

    protected function isSeatAvailable(): bool
    {
        $clause       = ['eiin' => $this->addColEiin, 'group_name' => $this->group];
        $details      = CollegeDetails::where($clause)->where('min_gpa', '<=', $this->sscGpa)->first();
        $totalSit     = data_get($details, 'total_seats');
        $availableSit = data_get($details, 'available_seats');
        $countApplied = Application::where('to_college_eiin', $details->eiin)->count();
        return $availableSit >= 1 && $availableSit < $totalSit && $availableSit < $countApplied;
    }

    protected function sendSms($student)
    {
        $phone = data_get($student, 'phone');

        if (!blank($student) && $phone) {
            $name     = data_get($student, 'name');
            $username = data_get($student, 'username');
            $password = data_get($student, 'pwd_hint');
            $rollNo   = data_get($student, 'academicInfo.ssc_roll_no');
            $regNo    = data_get($student, 'academicInfo.ssc_reg_no');
            $message  = "$name \nRoll No. - $rollNo \nReg. No. - $regNo \nUsername - $username \nPassword - $password\nYour application submitted successfully";
            app(SmsService::class)->post($phone, $message);
        }
    }

}
