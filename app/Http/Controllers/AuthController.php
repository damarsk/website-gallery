<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Controller as BaseController;

class AuthController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function signin()
    {
        return view('auth.login');
    }

    public function signup()
    {
        return view('auth.register');
    }

    public function signin_process()
    {
        $credentials = request()->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('/album');
        }

        return redirect('/signin')
            ->withInput()
            ->withErrors(['signin_error' => 'Invalid credentials. Please check your email and password and try again.']);
    }

    public function signup_process(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:5',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
        ], [
            'name.min' => 'Name minimal harus terdiri dari 5 karakter.',
            'password.min' => 'Password minimal harus terdiri dari 8 karakter.',
        ]);

        if ($validator->fails()) {
            return redirect('/signup')
                ->withInput()
                ->withErrors($validator);
        }

        $validatedData = $validator->validated();

        DB::table('users')->insert([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
            'level' => 'user',
            'created_at' => now(),
        ]);

        return redirect()->route('login')->with('success', 'Sign-up successful! Please log in.');
    }

    public function signout()
    {
        Auth::logout();
        return redirect('/');
    }
}
