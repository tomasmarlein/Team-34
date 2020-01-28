<?php

namespace App\Http\Controllers\Admin;

use App\Gebruikers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VerantwoordelijkeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.verantwoordelijke.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.verantwoordelijke.index');
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
            'naam' => 'required'
        ]);

        $gebruikers = new Gebruikers();
        $gebruikers->naam = $request->naam;
        $gebruikers->voornaam = $request->voornaam;
        $gebruikers->email = $request->email;
        $gebruikers->straat = $request->straat;
        $gebruikers->huisnummer = $request->huisnummer;
        $gebruikers->postcode = $request->postcode;
        $gebruikers->telefoon = $request->telefoon;
        $gebruikers->geboortedatum = $request->geboortedatum;
        $gebruikers->rolId = 3;
        $gebruikers->save();
        return response()->json([
            'type' => 'success',
            'text' => "De gebruiker <b>$gebruikers->name</b> is toegevoegd"
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Gebruikers $gebruikers
     * @return \Illuminate\Http\Response
     */
    public function show(Gebruikers $gebruikers)
    {
        return redirect('admin/verantwoordelijke');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Gebruikers  $gebruikers
     * @return \Illuminate\Http\Response
     */
    public function edit(Gebruikers $gebruikers)
    {
        $result = compact('verantwoordlijke');
        return view('admin.verantwoordelijke.edit', $result);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Gebruikers $gebruikers
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request, Gebruikers $gebruikers)
    {
        $data = $request->all();
        $gebruikers = \App\Gebruikers::find($id)->update([
            'naam' => $data['naam'],
            'voornaam' => $data['voornaam'],
            'email' => $data['email'],
            'straat' => $data['straat'],
            'huisnummer' => $data['huisnummer'],
            'postcode' => $data['postcode'],
            'geboortedatum' => $data['geboortedatum'],
            'telefoon' => $data['telefoon'],
        ]);


        return response()->json([
            'type' => 'success',
            'text' => "De verantwoordelijke <b>$gebruikers->name</b> is geupdate"
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Gebruikers $gebruikers
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, verantwoordlijke $verantwoordlijke)
    {
        $gebruiker = \App\Gebruikers::find($id)->delete();


        return response()->json([
            'type' => 'success',
            'text' => "De vrijwilliger <b>$verantwoordlijke->naam $verantwoordlijke->voornaam</b> is verwijderd!"
        ]);
    }

    public function qryVerantwoordelijke()
    {
        $gebruikers = Gebruikers::orderBy('naam')
            ->where('rolId', 3)
            ->with ('lid')
            ->get();
        return $gebruikers;
    }
}
