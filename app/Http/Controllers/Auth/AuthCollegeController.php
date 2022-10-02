<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\InstInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AuthCollegeController extends Controller
{

    public function index()
    {
        return view('auth.college-login');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'eiin'     => 'required',
            'password' => 'required'
        ]);

        $user = InstInfo::where( ['eiin'  => $request->get('eiin'), 'pass1' => $request->get('password')])->first();

        if ($user){
            auth()->guard('inst')->login($user);
            $request->session()->regenerate();
            return redirect()->route('college.dashboard');
        }
        return back()->with('error', 'EIIN And Password Are Wrong.');
    }


    public function destroy(Request $request)
    {
        Auth::guard('inst')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('index');
    }

}
