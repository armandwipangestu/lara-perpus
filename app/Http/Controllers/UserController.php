<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index(): View
    {
        return view('user.index', [
            'title' => 'My Profile',
            'user' => auth()->user()
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $user = auth()->user();
        $rules = [
            'first_name' => ['required', 'max:255'],
            'last_name' => ['required', 'max:255'],
            'gender' => ['required', 'max:6'],
            'address' => ['required'],
            'phone_number' => ['required', 'max:20'],
            'avatar_image' => ['image', 'file', 'mimes:jpg,png', 'max:2048']
        ];

        if ($request->username != $user->username) {
            $rules['username'] = ['required', 'min:3', 'max:255', 'unique:users', 'regex:/^[a-z0-9]+$/'];
        }

        if ($request->email != $user->email) {
            $rules['email'] = ['required', 'email:dns', 'unique:users'];
        }

        $validateData = $request->validate($rules);

        if ($request->file('avatar_image')) {
            if ($request->oldImage !== 'avatar_image/XcYXE7SOS3aFDTMQnpGoDY9yh6OydhA5CqfLpN0HFN1cu5ZugC.jpg' && $request->oldImage !== 'avatar_image/Cmh39TDbZbfRnmlYwhEFWiHcdv6MryF69tVjTp5xde2guZJF2E.jpg') {
                Storage::delete('public/assets/img/' . $request->oldImage);
            }

            $newImagePath = $request->file('avatar_image')->store('public/assets/img/avatar_image');
            $validateData['avatar_image'] = str_replace('public/assets/img/', '', $newImagePath);
        }

        User::where('id', $user->id)
            ->update($validateData);

        return redirect('/user')->with('success', 'Profile updated!');
    }

    public function changePassword(): View
    {
        return view('user.change-password', [
            'title' => 'Change Password',
            'user' => auth()->user()
        ]);
    }

    public function updatePassword(Request $request): RedirectResponse
    {
        Validator::extend('current_password', function ($attribute, $value, $parameters, $validator) {
            return Hash::check($value, auth()->user()->password);
        });

        $request->validate([
            'current_password' => ['required', 'current_password'],
            'new_password' => ['required', 'string', 'min:8', 'max:255', 'different:current_password'],
            'confirm_new_password' => ['required', 'string', 'same:new_password'],
        ]);

        $user = auth()->user();
        $newPassword = Hash::make($request->new_password);

        User::where('id', $user->id)
            ->update([
                'password' => $newPassword
            ]);

        return redirect('/user/change-password')->with('success', 'Password has been changed successfully!');
    }
}
