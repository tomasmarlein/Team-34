<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PasswordController extends Controller
{
    // Edit user password
    public function edit()
    {
        return view('user.password');
    }

    // Update and encrypt user password
    public function update(Request $request)
    {
        // Validate $request
        $this->validate($request,[
            'current_password' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);

        // Update encrypted user password in the database and redirect to previous page
        $gebruikers = gebruikers::findOrFail(auth()->id());
        if (!Hash::check($request->current_password, $gebruikers->password)) {
            session()->flash('danger', "Your current password doesn't mach the password in the database");
            return back();
        }
        $gebruikers->password = Hash::make($request->password);
        $gebruikers->save();
        session()->flash('success', 'Uw wachtwoord is verandert');
        return back();
    }
}
