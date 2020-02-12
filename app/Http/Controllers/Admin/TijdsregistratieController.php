<?php

namespace App\Http\Controllers\Admin;

use App\Tijdsregiestratie;
use App\Tijdsregistratie;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TijdsregistratieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.tijdsregistratie.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tijdsregiestratie  $tijdsregiestratie
     * @return \Illuminate\Http\Response
     */
    public function show(Tijdsregiestratie $tijdsregiestratie)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tijdsregiestratie  $tijdsregiestratie
     * @return \Illuminate\Http\Response
     */
    public function edit(Tijdsregiestratie $tijdsregiestratie)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tijdsregiestratie  $tijdsregiestratie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tijdsregiestratie $tijdsregiestratie)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tijdsregiestratie  $tijdsregiestratie
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tijdsregiestratie $tijdsregiestratie)
    {
        //
    }


    public function qryTijdsregistratie()
    {
        $tijdsregistratie = Tijdsregistratie::orderBy('checkIn')
            ->with ('verenigingTijd','gebruikerstijd','evenement')
            ->get();
        return $tijdsregistratie;
    }
}
