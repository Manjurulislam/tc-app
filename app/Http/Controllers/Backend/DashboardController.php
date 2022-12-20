<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\Student;
use App\Models\User;
use App\Service\DataService;
use Dflydev\DotAccessData\Data;
use Illuminate\Support\Facades\Storage;


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
        $user = auth()->user();

        if (data_get($user, 'user_role') == 1) {
            return view('backend.dashboard.pending-list');
        }

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
