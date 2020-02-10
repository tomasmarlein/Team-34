<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    // Edit user profile
    public function edit()
    {
        return view('shared.profile');
    }

    // Update user profile
    public function update(Request $request)
    {
        // Validate $request
        $this->validate($request,[
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . auth()->id()
        ]);

        // Update user in the database and redirect to previous page
        $gebruikers = gebruikers::findOrFail(auth()->id());
        $gebruikers->name = $request->name;
        $gebruikers->email = $request->email;
        $gebruikers->save();
        session()->flash('success', 'Uw profiel is  geupdate');
        return back();
    }
}
