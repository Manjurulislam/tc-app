<?php


namespace App\Service;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class StudentDetails
{

    public function post($rollNo, $year)
    {
        try {
            $apiUrl   = 'http://172.104.51.235:9999/api/student.php';
            $response = Http::timeout(25)->withOptions(['debug' => false, 'verify' => false,])
                ->get($apiUrl, $this->setBodyParam($rollNo, $year));

            $content = json_decode($response);

            return [
                'name'        => data_get($content, 'data.name', ''),
                'father_name' => data_get($content, 'data.father_name', ''),
                'mother_name' => data_get($content, 'data.mother_name', ''),
                'roll_no'     => data_get($content, 'data.roll', ''),
                'reg_no'      => data_get($content, 'data.registration', ''),
                'pass_year'   => data_get($content, 'data.year', ''),
                'board'       => data_get($content, 'data.board', ''),
                'gpa'         => data_get($content, 'data.gpa', ''),
            ];
        } catch (\Exception $e) {
            Log::debug($e);
            return [];
        }
    }

    public function setBodyParam($roll, $year): array
    {
        return [
            'board' => 'din',
            'exam'  => 'ssc',
            'year'  => $year,
            'roll'  => $roll,
        ];
    }
}
