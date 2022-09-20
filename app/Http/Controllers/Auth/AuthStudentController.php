<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AuthStudentController extends Controller
{

    public function index()
    {
        return view('auth.student-login');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required'
        ]);

        $attempt = auth()->guard('student')->attempt(
            ['username' => $request->get('username'),
             'password' => $request->get('password')]
        );

        if ($attempt) {
            return redirect()->route('student.dashboard');
        }
        return back()->with('error', 'Username And Password Are Wrong.');
    }


    public function destroy(Request $request)
    {
        Auth::guard('student')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('index');
    }

}
