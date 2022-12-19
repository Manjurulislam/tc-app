<?php

namespace App\Http\Controllers\Frontend;

use App\Enum\MessageEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\ApplicationRequest;
use App\Service\CommonService;
use App\Service\SmsService;
use DB;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;


class ApplicationController extends Controller
{


    public function testSms()
    {
        $response = app(SmsService::class)->send();

        dd($response);
    }


}
