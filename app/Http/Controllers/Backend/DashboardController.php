<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\Student;


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


    public function getApprove()
    {
        return view('backend.dashboard.approve-list');
    }

    public function comments()
    {
        return view('backend.comment.index');
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
