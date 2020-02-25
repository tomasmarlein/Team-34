<?php

namespace App\Http\Controllers\User;

use App\Gebruikers;
use Hash;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PasswordController extends Controller
{
    // Edit user password
    public function edit()
    {
        return view('shared.password');
    }

    // Update and encrypt user password
    public function update(Request $request)
    {
        $this->validate($request,[
            'current_password' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);

        $gebruiker = Gebruikers::findOrFail(auth()->id());
        if (!Hash::check($request->current_password, $gebruiker->password)) {
            session()->flash('danger', "Your current password doesn't mach the password in the database");
            return back();
        }
        $gebruiker->password = Hash::make($request->password);
        $gebruiker->save();

        // Update encrypted user password in the database and redirect to previous page
        session()->flash('success', 'Your password has been updated');
        return back();

    }
}
