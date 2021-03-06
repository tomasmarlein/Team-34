<?php

namespace App\Http\Controllers\Admin;

use App\Exports\HeadTijdsregistratieExport;
use App\Verenigings;
use App\Tijdsregistratie;
use Facades\App\Helpers\Json;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class TijdsregistratieController extends Controller
{
    /**
     * Display a listing of the resource.
     *

     * @param Request $request
     * @return \Illuminate\Http\Response
     */



    public function export()
    {
        return Excel::download(new HeadTijdsregistratieExport(), 'Tijdsregistraties.xlsx');
    }

    public function index(Request $request )
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
    public function show(Tijdsregistratie $tijdsregiestratie)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tijdsregiestratie  $tijdsregiestratie
     * @return \Illuminate\Http\Response
     */
    public function edit(Tijdsregistratie $tijdsregiestratie)
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
    public function update($id, Request $request)
    {
        $data = $request->all();

        \App\Tijdsregistratie::find($id)
            ->update([
                'adminCheckIn' => $data['adminCheckIn'],
                'adminCheckUit' => $data['adminCheckUit'],
            ]);


        return response()->json([
            'type' => 'success',
            'text' => "De tijdsregistratie is geupdate"
        ]);
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

    public function qryTijdsregistratie(){
        $tijdsregistraties = Tijdsregistratie::orderBy('checkIn', 'desc')
            ->with ('verenigingTijd','gebruikerstijd','evenement', 'gebruikerstijd.lid')
            ->get();
        return $tijdsregistraties;
    }
}
