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
        // Validate $request
        $this->validate($request,[
            'current_password' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);

        $gebruikers = new Gebruikers();

        // Update encrypted user password in the database and redirect to previous page
//        $gebruiker = Gebruikers::findOrFail(auth()->id());

        $gebruiker = Gebruikers::orderBy('id')
            ->where('id','=',auth()->id())
            ->get();

//        if (!Hash::check($request->password, $gebruiker->password)) {
//            session()->flash('danger', "Gelieve het correcte huidige wachtwoord in te geven.");
//            return back();
//        }
        $gebruiker->password = Hash::make($request->password);
        $gebruikers->password = $gebruiker->password;

        $gebruikers->save();
        session()->flash('success', 'Uw wachtwoord is verandert');
        return back();
    }
}
