<?php

namespace App\Service;

use App\Models\Student;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SmsService
{
    private $apiUrl;

    public function __construct()
    {
        $this->apiUrl = 'https://gpcmp.grameenphone.com/ecmapigw/webresources/ecmapigw.v2';
    }


    public function send()
    {
        $student  = Student::find(1);
        $name     = data_get($student, 'name');
        $phone    = data_get($student, 'phone');
        $username = data_get($student, 'username');
        $password = data_get($student, 'pwd_hint');
        $rollNo   = data_get($student, 'academicInfo.ssc_roll_no');
        $regNo    = data_get($student, 'academicInfo.ssc_reg_no');
        $message  = "$name \nRole No. - $rollNo \nReg. No. - $regNo \nUsername - $username \nPassword - $password\nYour application submitted successfully";

        $sms      = $this->post($phone, $message);
        return $sms;
    }


    public function post($phone, $message): bool
    {
        try {
            $request  = Http::withOptions(['verify' => false, 'debug' => false])
                ->post($this->apiUrl, $this->setBodyParam($phone, $message));
            $response = json_decode($request->body());
            //store log
            Log::channel('sms')->info('sms info', [
                'request'  => ['phone' => $phone, 'text' => $message],
                'response' => $response,
            ]);
            return data_get($response, 'statusCode') == 200;
        } catch (\Exception $e) {
            Log::channel('sms')->error('sms error', [$e]);
            return false;
        }
    }


    private function setBodyParam($phone, $message): array
    {
        return [
            "username"    => "Dinajpurboard",
            "password"    => "gpdinB0ard@",
            "apicode"     => "1",
            "msisdn"      => $phone,
            "countrycode" => "880",
            "cli"         => "DINJ BOARD",
            "messagetype" => "1",
            "message"     => $message,
            "messageid"   => "0",
        ];
    }
}
