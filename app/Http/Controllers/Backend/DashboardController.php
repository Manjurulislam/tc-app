<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\Student;


class DashboardController extends Controller
{

    public function index()
    {
        $pending   = Application::pending()->count();
        $literally = Application::correction()->count();
        $meeting   = Application::meeting()->count();
        $invalid   = Application::invalid()->count();
        $approved  = Application::approve()->count();
        return view('backend.dashboard.index', compact('pending', 'literally', 'meeting', 'approved', 'invalid'));
    }

    public function getPending()
    {
        return view('backend.dashboard.pending-list');
    }

    public function getLiterally()
    {
        return view('backend.dashboard.literally-list');
    }

    public function getMeetings()
    {
        return view('backend.dashboard.meeting-list');
    }

    public function getApprove()
    {
        return view('backend.dashboard.approve-list');
    }

    public function getInvalid()
    {
        return view('backend.dashboard.invalid-list');
    }


    //================================ student =========================

    public function dashboard()
    {
        $student = auth()->guard('student')->user();
        return view('backend.student.index', compact('student'));
    }
}
