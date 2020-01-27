<?php

namespace App\Http\Controllers\Admin;

use App\Evenements;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EvenementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.evenementen.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $evenements = new Evenements();
        $result = compact('evenements');
        return view('admin.evenementen.index',$result);
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
            'naam' => 'required|min:3|unique:evenements,naam'
        ]);

        $evenements = new Evenements();
        $evenements->naam = $request->naam;
        $evenements->startdatum = $request->startdatum;
        $evenements->einddatum = $request->einddatum;
        $evenements->actief = $request->actief;
        $evenements->save();
        return response()->json([
            'type' => 'success',
            'text' => "Het evenement <b>$evenements->naam</b> is toegevoegd"
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Evenements  $evenements
     * @return \Illuminate\Http\Response
     */
    public function show(Evenements $evenements)
    {
        return redirect('admin/evenementen');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Evenements  $evenements
     * @return \Illuminate\Http\Response
     */
    public function edit(Evenements $evenements)
    {
        return redirect('admin/evenementen');

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Evenements  $evenements
     * @return \Illuminate\Http\Response
     */
    public function update($id,Request $request, Evenements $evenements)
    {
        $data = $request->all();
        $evenement = \App\Evenements::find($id)->update([
            'naam' => $data['naam'],
            'startdatum' => $data['startdatum'],
            'einddatum' => $data['einddatum'],
            'actief' => $data['actief'],
        ]);


        return response()->json([
            'type' => 'success',
            'text' => "The vrijwilliger <b>$evenements->name</b> is geupdate"
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Evenements  $evenements
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Evenements $evenements)
    {
        $evenement = \App\Gebruikers::find($id)->delete();


        return response()->json([
            'type' => 'success',
            'text' => "Het evenement <b>$evenements->naam</b> is verwijderd!"
        ]);
    }

    public function qryEvenementen()
    {
        $evenementen = Evenements::orderBy('id')
            ->get();
        return $evenementen;
    }
}
