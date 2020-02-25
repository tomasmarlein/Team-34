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

    public function index()

    {
        $vereniging_id = $request->input('vereniging_id') ?? '%';
        $naam = '%' . $request->input('naam') . '%';

        $verenigingen = verenigings::orderby('naam')
            ->get((['id','naam']));

        $tijdsregistraties = Tijdsregistratie::orderBy('checkIn', 'desc')
            ->with ('verenigingTijd','gebruikerstijd','evenement', 'gebruikerstijd.lid')

            ->where('verenigings_id', 'like', $vereniging_id)

            ->get();
        $result = compact('tijdsregistraties', 'verenigingen');
        Json::dump($result);

        return view('admin.tijdsregistratie.index', $result);
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
        $result = compact('tijdsregiestratie');
        Json::dump($result);
        return view('admin.tijdsregistratie.edit', $result);
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

}
