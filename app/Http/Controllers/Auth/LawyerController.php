<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class LawyerController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:lawyer');
    }
    public function showLoginForm()
    {
        return view('auth.lawyer-login');
    }
    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);
        if (Auth::guard('lawyer')->attempt(['email'=>$request->email, 'password'=>$request->password], $request->remeber)) {
            return redirect()->indended(route('lawyer.dashboard'));
        }
        return redirect()->back()->withInput($request->only('email', 'remember'));
    }
}
