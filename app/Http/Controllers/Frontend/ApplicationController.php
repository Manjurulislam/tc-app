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

    public function store(ApplicationRequest $request): JsonResponse
    {
        try {
            $store = app(CommonService::class)->create($request);
            return response()->json(['status' => 200, 'message' => MessageEnum::SUCCESS]);
        } catch (\Exception $e) {
            return response()->json(['status' => 400, 'message' => MessageEnum::EXCEPTION], 500);
        }
    }


    public function testSms()
    {
        $response = app(SmsService::class)->post('01773329719', 'Hello world');

        dd($response);
    }


}
