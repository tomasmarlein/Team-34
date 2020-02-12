<?php

namespace App\Http\Controllers\Admin;

use App\Gebruikers;
use App\Verenigings;
use Hash;
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
            'naam' => 'required',
            'voornaam' => 'required',
            'email' => 'required',
            'geboortedatum' => 'required'
        ]);
        $gebruikers = new Gebruikers();
        $gebruikers->naam = $request->naam;
        $gebruikers->voornaam = $request->voornaam;
        if($request->roepnaam == ""){
            $gebruikers->roepnaam = null;
        } else {
            $gebruikers->roepnaam = $request->roepnaam;
        }
        $gebruikers->rijksregisternr = $request->rijksregisternummer;
        $gebruikers->email = $request->email;
        $gebruikers->password = Hash::make("azerty12");
        $gebruikers->telefoon = $request->telefoon;
        $gebruikers->geboortedatum = $request->geboortedatum;
        $gebruikers->tweedetshirt = 0;
        $gebruikers->eersteAanmelding = 0;
        $gebruikers->lunchpakket = 0;
        $gebruikers->tshirtId = null;
        $gebruikers->rolId = 3;
        $gebruikers->save();
        $gebruiker_id = Gebruikers::orderby('naam')
            ->where('naam', $request->naam)
            ->select('id')
            ->get();
        $gebruiker = Gebruikers::find($gebruikers->id);
        $gebruiker->lid()->sync(['verenigings_id' => $request->vereniging_id], ['gebruikers_id' => $gebruiker_id]);
        if($request->verantwoordelijke_id == 1){
            \App\Verenigings::find($request->vereniging_id)->update([
                'hoofdverantwoordelijke' => $gebruikers->id
            ]);
        } else {
            \App\Verenigings::find($request->vereniging_id)->update([
                'tweedeverantwoordelijke' => $gebruikers->id
            ]);
        }
        return response()->json([
            'type' => 'success',
            'text' => "De verantwoordelijke <b>$gebruikers->name</b> is toegevoegd"
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
        if($data['roepnaam'] == ""){
            $gebruikers = \App\Gebruikers::find($id)->update([
                'naam' => $data['naam'],
                'voornaam' => $data['voornaam'],
                'roepnaam' => null,
                'email' => $data['email'],
                'rijksregisternr' => $data['rijksregisternummer'],
                'geboortedatum' => $data['geboortedatum'],
                'telefoon' => $data['telefoon'],
            ]);
        } else {
            $gebruikers = \App\Gebruikers::find($id)->update([
                'naam' => $data['naam'],
                'voornaam' => $data['voornaam'],
                'roepnaam' => $data['roepnaam'],
                'email' => $data['email'],
                'rijksregisternr' => $data['rijksregisternummer'],
                'geboortedatum' => $data['geboortedatum'],
                'telefoon' => $data['telefoon'],
            ]);
        }

        return response()->json([
            'type' => 'success',
            'text' => "De verantwoordelijke is geupdate"
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
        $gebruikers = Verenigings::orderBy('naam')
        ->with ('vereniginglid')
        ->get();
        return $gebruikers;
    }



    public function qryLeden(){
        $gebruikers = Gebruikers::orderBy('naam')
            ->where('vereniging' , '=' , 'PianoVereniging')
            ->get();
    }
}
