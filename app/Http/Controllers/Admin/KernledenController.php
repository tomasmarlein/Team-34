<?php

namespace App\Http\Controllers\Admin;

use App\Gebruikers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class KernledenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.kernleden.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return redirect('admin/kernleden');
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
            'naam' => 'required|min:3|unique:gebruikers,naam'
        ]);

        $gebruikers = new Gebruikers();
        $gebruikers->naam = $request->naam;
        $gebruikers->voornaam = $request->voornaam;
        $gebruikers->email = $request->email;
        $gebruikers->telefoon = $request->telefoon;
        $gebruikers->geboortedatum = $request->geboortedatum;
        $gebruikers->rolId = 2;
        $gebruikers->save();
        return response()->json([
            'type' => 'success',
            'text' => "Kernlid: <b>$gebruikers->name</b> is toegevoegd"
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
        return redirect('admin/kernleden');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Gebruikers  $gebruikers
     * @return \Illuminate\Http\Response
     */
    public function edit(Gebruikers $gebruikers)
    {
        return redirect('admin/kernleden');
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
        $gebruiker = \App\Gebruikers::find($id)->update([
            'naam' => $data['naam'],
            'voornaam' => $data['voornaam'],
            'email' => $data['email'],
            'geboortedatum' => $data['geboortedatum'],
            'telefoon' => $data['telefoon'],
        ]);


        return response()->json([
            'type' => 'success',
            'text' => "Kernlid is geupdate"
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
            'text' => "Kernlid: <b>$gebruikers->naam $gebruikers->voornaam</b> is verwijderd!"
        ]);
    }

    public function qryKernleden()
    {
        $gebruikers = Gebruikers::orderBy('id')
            ->where('rolId', '=', 2)
            ->get();
        return $gebruikers;
    }
}
