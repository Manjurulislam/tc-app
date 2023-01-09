<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\Student;
use App\Models\User;
use App\Service\DataService;
use Dflydev\DotAccessData\Data;
use Illuminate\Support\Facades\Storage;
use Mpdf\Mpdf;


class DashboardController extends Controller
{

    public function index()
    {
        $pending  = Application::pending()->count();
        $approved = Application::approve()->count();
        return view('backend.dashboard.index', compact('pending', 'approved'));
    }

    public function getPending()
    {
        $user     = auth()->user();
        $userRole = data_get($user, 'user_role');

//        if ($userRole == 3 || $userRole == 4) {
//            return view('backend.dashboard.pending-list');
//        }
        return view('backend.college.index');
    }


    //=============================================
    public function details(Application $application)
    {
        $data = resolve(DataService::class)->transformApplication($application);
        return view('backend.application.details', compact('data'));
    }

    public function downloadMarksheet(Application $application)
    {
        $attachment = data_get($application, 'student.academicInfo.attachment');
        return Storage::disk('public')->download($attachment);
    }

    public function downloadApproveList()
    {
//        $sharok = Application::approve()->get();
//        $data   = $sharok->groupBy('sharok_no');




        $mpdf = new Mpdf([
            'mode'   => 'utf-8',
            'format' => 'A4',
        ]);

        $view = view('pdf.approve');
        $mpdf->WriteHTML($view->render());
//        $mpdf->Output('invoice.pdf', 'D');
        $mpdf->Output('filename.pdf', 'I');
//        dd($data);
    }

    //===============================================

    public function getApprove()
    {
        return view('backend.dashboard.approve-list');
    }

    public function comments()
    {
        return view('backend.comment.index');
    }

    public function signatures()
    {
        return view('backend.signature.index');
    }

    //================================ student =========================

    public function student()
    {
        $student = auth()->guard('student')->user();
        return view('backend.student.index', compact('student'));
    }

    public function college()
    {
        return view('backend.college.index');
    }
}
