<?php


namespace App\Service;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class StudentDetails
{

    public function post(Request $request): object
    {
        try {
            $apiUrl   = 'http://172.104.51.235:9999/api/student.php';
            $exam     = $request->exam;
            $year     = $request->year;
            $rollNo   = $request->rollNo;
            $response = Http::timeout(25)->withOptions([
                'debug'  => false,
                'verify' => false,
            ])->get($apiUrl, $this->setBodyParam($exam, $year, $rollNo));

            $content = json_decode($response);

            $data = [
                'name'        => data_get($content, 'data.name', ''),
                'father_name' => data_get($content, 'data.father_name', ''),
                'mother_name' => data_get($content, 'data.mother_name', ''),
                'gender'      => data_get($content, 'data.gender', ''),
                'dob'         => data_get($content, 'data.dob', ''),
                'roll'        => data_get($content, 'data.roll', ''),
                'reg_no'      => data_get($content, 'data.registration', ''),
                'eiin_no'     => data_get($content, 'data.eiin', ''),
                'exam'        => data_get($content, 'data.exam', ''),
                'session'     => data_get($content, 'data.session', ''),
                'year'        => data_get($content, 'data.year', ''),
                'religion'    => data_get($content, 'data.religion', ''),
            ];

            $status = data_get($content, 'status');

            return (object) [
                'status'  => $status == 'success' ? 200 : 400,
                'message' => $status == 'success' ? 'Student found' : 'Data not found',
                'data'    => $status == 'success' ? $data : [],
            ];
        } catch (\Exception $e) {
            Log::debug($e->getMessage());
            return (object) [
                'status'  => 500,
                'message' => 'Something went wrong',
                'data'    => [],
            ];
        }
    }

    public function setBodyParam($exam, $year, $roll): array
    {
        return [
            'board' => 'din',
            'exam'  => $exam,
            'year'  => $year,
            'roll'  => $roll,
        ];
    }
}
