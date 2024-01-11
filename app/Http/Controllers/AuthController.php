<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Support\ValidatedData;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index(): View
    {
        return view('auth.index', [
            "title" => "Sign in"
        ]);
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

        $validateData['password'] = Hash::make($validateData['password']);

        User::create($validateData);

        return redirect('/auth')->with('success', 'Your account has been successfully registered, please log in');
    }
}
