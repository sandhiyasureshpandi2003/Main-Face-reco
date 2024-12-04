<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class SettingsController extends Controller
{
    public function showSettings()
    {
        $user = Auth::user();
        return view('settings', compact('user'));
    }

    public function updateSettings(Request $request)
    {
        $user = Auth::user();
        $validator = Validator::make($request->all(), [
            'username' => 'sometimes|string|max:100',
            'email' => 'sometimes|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6',
            'phone_number' => 'nullable|numeric',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
            
        }

        $request_data = $validator->validate();
       
        if ($request->hasFile('profile_picture')) {
            $path = $request->file('profile_picture')->store('profile_pictures', 'public');
            $request_data['profile_picture'] = $path;
        }

        if (isset($request_data['password'])) {
            $request_data['password'] = Hash::make($request_data['password']);
        }

        $user->update($request_data);

        return redirect()->route('settings.show')->with('success', 'Settings updated successfully.');
    }
}
