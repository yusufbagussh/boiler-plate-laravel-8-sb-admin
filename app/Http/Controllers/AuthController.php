<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login', [
            'title' => 'Login',
            'active' => 'login'
        ]);
    }

    public function register()
    {
        return view('auth.register', [
            'tittle' => 'Register',
            'active' => 'register'
        ]);
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required | max:255',
            'email' => ['required', 'email'],
            'password' => ['required', 'min:5', 'max:255'],
            'confirm_password' => ['required', 'same:password'],
        ]);
        $validateData['password'] = Hash::make($validateData['password']);
        $validateData['role'] = $request->role;
        // var_dump($validateData['role']);
        User::create($validateData);
        Alert::success('Congrats', 'You\'ve Successfully Registered');
        return redirect('/login')->with('success', 'Registration Successfull! Please Login');
    }

    public function auth(Request $request)
    {
        $credential = $request->validate([
            'email' => 'required | email:dns',
            'password' => 'required'
        ]);

        if (Auth::attempt($credential)) {
            $request->session()->regenerate();
            if (auth()->user()->role === 'Admin') {
                // $request->session()->regenerate();
                return redirect()->intended('/super/dashboard');
            } else {
                // $request->session()->regenerate();
                Alert::success('Congrats', 'You\'ve Successfully Login');
                // toast('Success Login!', 'success');
                return redirect()->intended('/user/dashboard');
            }
        }

        return back()->with('loginError', 'Login Failed!!!');
    }

    public function logout()
    {
        Auth::logout();

        request()->session()->invalidate();

        request()->session()->regenerateToken();
        Alert::success('Congrats', 'You\'ve Successfully Logout');
        return redirect('/login');
    }
}
