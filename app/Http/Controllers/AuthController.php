<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Support\ValidatedData;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index(): View
    {
        return view('auth.index', [
            "title" => "Sign in"
        ]);
    }

    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'identity' => ['required'],
            'password' => ['required']
        ]);

        $fieldType = filter_var($credentials['identity'], FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        if (Auth::attempt([
            $fieldType => $credentials['identity'],
            'password' => $request->input('password')
        ])) {
            $request->session()->regenerate();

            $role = auth()->user()->role->name;

            if ($role === "Administrator") {
                return redirect()->intended('/admin');
            }

            if ($role === "Operator") {
                return redirect()->intended('/operator');
            }

            if ($role === "Member") {
                return redirect()->intended('/member');
            }
        }

        return back()->with('loginError', 'Login failed!');
    }

    public function signout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/signin')->with('success', 'Successfully signout!');
    }

    public function signup(): View
    {
        return view('auth.signup', [
            "title" => "Sign up"
        ]);
    }

    public function storeSignup(Request $request): RedirectResponse
    {
        $validateData = $request->validate([
            'first_name' => ['required', 'max:255'],
            'last_name' => ['required', 'max:255'],
            'username' => ['required', 'min:3', 'max:255', 'unique:users', 'regex:/^[a-z0-9]+$/'],
            'gender' => ['required', 'max:6'],
            'address' => ['required'],
            'phone_number' => ['required', 'max:20'],
            'email' => ['required', 'email:dns', 'unique:users'],
            'password' => ['required', 'min:8', 'max:255', 'confirmed']
        ]);

        if ($validateData['gender'] === 'Male') {
            $validateData['avatar_image'] = 'avatar_image/XcYXE7SOS3aFDTMQnpGoDY9yh6OydhA5CqfLpN0HFN1cu5ZugC.jpg';
        }

        if ($validateData['gender'] === 'Female') {
            $validateData['avatar_image'] = 'avatar_image/Cmh39TDbZbfRnmlYwhEFWiHcdv6MryF69tVjTp5xde2guZJF2E.jpg';
        }

        $validateData['password'] = Hash::make($validateData['password']);

        User::create($validateData);

        return redirect('/signin')->with('success', 'Your account has been successfully registered, please log in');
    }
}
