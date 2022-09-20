<?php

namespace App\Service;

use Illuminate\Support\Facades\Http;

class SmsService
{
    private $apiUrl;

    public function __construct()
    {
        $this->apiUrl = 'http://202.56.5.148/gpcmpapi/messageplatform/controller.home';
    }

    public function post($phone, $message)
    {
        $request  = Http::withOptions(['verify' => false, 'debug' => false])
            ->post($this->apiUrl, $this->setBodyParam($phone, $message));
        $response = json_decode($request->body());

        return $response;
    }


    private function setBodyParam($phone, $message): array
    {
        return [
            "username"    => "Dinajpurboard",
            "password"    => "gpdinB0ard@",
//            "password"    => "dInJ17@Bo@rd",
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
