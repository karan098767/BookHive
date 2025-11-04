<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate(['email'=>'required|email','password'=>'required']);
        $admin = Admin::where('email',$request->email)->first();
        if (!$admin || !Hash::check($request->password, $admin->password)) {
            return back()->withErrors(['email'=>'Invalid credentials']);
        }
        session(['admin_id' => $admin->id]);
        return redirect()->route('admin.dashboard');
    }

    public function logout()
    {
        session()->forget('admin_id');
        return redirect()->route('admin.login');
    }
}
