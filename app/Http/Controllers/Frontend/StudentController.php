<?php

namespace App\Http\Controllers\Frontend;

use App\Enum\ApplicationStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\StudentRequest;
use App\Models\CenterInfo;
use App\Models\Exam;
use App\Service\CommonService;
use App\Service\StudentDetails;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Mpdf\Config\ConfigVariables;
use Mpdf\Config\FontVariables;
use Mpdf\Mpdf;

class StudentController extends Controller
{


    public function index()
    {
//        $exams       = Exam::active()->get();
//        $passingYear = app(CommonService::class)->generateYears() ?? [];
        return view('frontend.pages.index');
    }

    public function getDetails(Request $request)
    {
        $response = app(StudentDetails::class)->post(data_get($request,'roll'), data_get($request,'year'));




        dd($response);
    }

}
