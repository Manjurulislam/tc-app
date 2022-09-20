<?php


namespace App\Service;

use App\Models\Application;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;


class CommonService
{

    /**
     * @throws \Throwable
     */
    public function create(Request $request)
    {
        [$studentInfo, $correction, $exams] = $this->prepareData($request);

        DB::beginTransaction();
        try {
            //==== student and attachments ==================
            $student = Student::updateOrCreate(
                ['phone' => $request->get('phone')
                ], $studentInfo);

            $this->saveDocument($request, $student);
            //== application exam info ====
            $application = $student->application()->create($correction);
            $this->saveExams($exams, $application);
            DB::commit();
            return $student;
        } catch (\Exception $e) {
            Log::error($e);
            DB::rollback();
            return [];
        }
    }


    private function saveExams($exams, Application $application)
    {
        if (!blank($exams)) {
            $appliedExam = $exams->map(function ($item) {
                return [
                    'exam_id'      => $item->id,
                    'eiin_no'      => $item->eiin_no,
                    'roll_no'      => $item->roll,
                    'reg_no'       => $item->reg_no,
                    'passing_year' => $item->passing_year,
                    'session'      => $item->session,
                    'center'       => $item->centre,
                ];
            });
            $application->exams()->createMany($appliedExam);
        }
    }


    private function saveDocument(Request $request, Student $student)
    {
        $boc   = $request->file(Student::BIRTH_CERTIFICATE);
        $psc   = $request->file(Student::SCHOOL_CERTIFICATE);
        $testi = $request->file(Student::TESTIMONIAL);
        $nid   = $request->file(Student::NID);
        $afd   = $request->file(Student::AFIDAFIT);
        $doc   = $request->file(Student::EXTRA_DOC);
        $nidg  = $request->file(Student::NID_GUARDIAN);
        $photo = $request->file(Student::PHOTO);

        if ($boc) {
            $student->addMedia($boc)->toMediaCollection(Student::BIRTH_CERTIFICATE);
        }

        if ($psc) {
            $student->addMedia($psc)->toMediaCollection(Student::SCHOOL_CERTIFICATE);
        }

        if ($testi) {
            $student->addMedia($testi)->toMediaCollection(Student::TESTIMONIAL);
        }

        if ($nid) {
            $student->addMedia($nid)->toMediaCollection(Student::NID);
        }

        if ($afd) {
            $student->addMedia($afd)->toMediaCollection(Student::AFIDAFIT);
        }

        if ($doc) {
            $student->addMedia($doc)->toMediaCollection(Student::EXTRA_DOC);
        }

        if ($nidg) {
            $student->addMedia($nidg)->toMediaCollection(Student::NID_GUARDIAN);
        }

        if ($photo) {
            $student->addMedia($photo)->toMediaCollection(Student::PHOTO);
        }
    }


    private function prepareData(Request $request): array
    {
        $password = Str::random(8) . 'db';

        $student = [
            'eiin_no'           => $request->get('eiin_no'),
            'name'              => $request->get('name'),
            'father_name'       => $request->get('father_name'),
            'mother_name'       => $request->get('mother_name'),
            'dob'               => $request->get('dob'),
            'phone'             => $request->get('phone'),
            'gender'            => $request->get('gender'),
            'religion'          => $request->get('religion'),
            'center_code'       => $request->get('center_code'),
            'institute'         => $request->get('institute'),
            'present_address'   => $request->get('present_address'),
            'permanent_address' => $request->get('permanent_address'),
            'username'          => $request->get('roll') . 'DB',
            'password'          => bcrypt($password),
            'pwd_hint'          => $password,
        ];

        $application = [
            'application_no'  => 'AP' . Str::random(8),
            'cor_name'        => $request->get('cor_name'),
            'cor_father_name' => $request->get('cor_father_name'),
            'cor_mother_name' => $request->get('cor_mother_name'),
            'cor_religion'    => $request->get('cor_religion'),
            'cor_gender'      => $request->get('cor_gender'),
            'cor_dob'         => $request->get('cor_dob'),
            'sonali_sheba_no' => $request->get('sonali_sheba_no'),
            'remarks'         => $request->get('remarks'),
        ];

        $selectExams  = json_decode($request->get('correctionExams'));
        $selectExamId = json_decode($request->get('selectedExam'));
        $exams        = collect($selectExams)->whereIn('id', $selectExamId)->values();
        return [$student, $application, $exams];
    }

    public function sendSms(Student $student)
    {
        $phone   = data_get($student, 'phone');
        $message = '';


    }


    public function generateYears(): array
    {
        $earliest_year = 1964;
        $latest_year   = date('Y');
        $years         = [];
        foreach (range($latest_year, $earliest_year) as $key => $i) {
            $years[$key] = $i;
        }
        return $years;
    }


}
