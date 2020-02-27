<?php

namespace App\Http\Controllers\Admin;

use App\Gebruikers;
use Hash;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.admin.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return redirect('admin/admin');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'naam' => 'required|min:3|unique:gebruikers,naam',
            'wachtwoord' => 'required'
        ]);

        $gebruikers = new Gebruikers();
        $gebruikers->naam = $request->naam;
        $gebruikers->voornaam = $request->voornaam;
        $gebruikers->email = $request->email;
        $gebruikers->password = Hash::make($request->wachtwoord);
        $gebruikers->telefoon = $request->telefoon;
        $gebruikers->geboortedatum = $request->geboortedatum;
        $gebruikers->rijksregisternr = 1;
        $gebruikers->rolId = 1;
        $gebruikers->save();

        return response()->json([
            'type' => 'success',
            'text' => "Admin: <b>$request->naam $request->voornaam</b> is toegevoegd"
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Gebruikers  $gebruikers
     * @return \Illuminate\Http\Response
     */
    public function show(Gebruikers $gebruikers)
    {
        return redirect('admin/admin');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Gebruikers  $gebruikers
     * @return \Illuminate\Http\Response
     */
    public function edit(Gebruikers $gebruikers)
    {
        return redirect('admin/admin');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Gebruikers  $gebruikers
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request, Gebruikers $gebruikers)
    {
        $data = $request->all();

        if($request->rol_id != 'leeg'){
            $gebruiker = \App\Gebruikers::find($id)->update([
                'naam' => $data['naam'],
                'voornaam' => $data['voornaam'],
                'email' => $data['email'],
                'geboortedatum' => $data['geboortedatum'],
                'telefoon' => $data['telefoon'],
                'rolId' => $data['rol_id']
            ]);
        } else {
            $gebruiker = \App\Gebruikers::find($id)->update([
                'naam' => $data['naam'],
                'voornaam' => $data['voornaam'],
                'email' => $data['email'],
                'geboortedatum' => $data['geboortedatum'],
                'telefoon' => $data['telefoon'],
                'rolId' => 1
            ]);
        }


        $gebruiker = \App\Gebruikers::find($id)->update([
            'naam' => $data['naam'],
            'voornaam' => $data['voornaam'],
            'email' => $data['email'],
            'geboortedatum' => $data['geboortedatum'],
            'telefoon' => $data['telefoon'],
        ]);

        return response()->json([
            'type' => 'success',
            'text' => "Admin is geupdate"
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Gebruikers  $gebruikers
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Gebruikers $gebruikers)
    {
        $gebruiker = \App\Gebruikers::find($id)->delete();

        return response()->json([
            'type' => 'success',
            'text' => "Admin is verwijderd!"
        ]);
    }

    public function qryAdmins()
    {
        $admin = Gebruikers::orderBy('id')
            ->where('rolId', '=', 1)
            ->get();

        return $admin;
    }
}
