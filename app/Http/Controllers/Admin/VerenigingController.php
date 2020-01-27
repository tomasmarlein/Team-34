<?php

namespace App\Http\Controllers\Admin;


use App\Verenigings;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class VerenigingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.verenigingen.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $verenigingen = new Verenigings();
        $result = compact('verenigingen');
        return view('admin.verenigingen.create',$result);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'naam' => 'required',
            'rekeningnr' => 'required',
            'hoofdverantwoordelijke' => 'required',
            'btwnr' => 'required',
            'straat' => 'required',
            'huisnummer' => 'required',
            'postcode' => 'required',
            'gemeente' => 'required',
        ]);

        $verenigings = new Verenigings();
        $verenigings->naam = $request->naam;
        $verenigings->rekeningnr = $request->rekeningnr;
        $verenigings->hoofdverantwoordelijke = $request->hoofdverantwoordelijke;
        $verenigings->btwnr = $request->btwnr;
        $verenigings->straat = $request->straat;
        $verenigings->huisnummer = $request->huisnummer;
        $verenigings->postcode = $request->postcode;
        $verenigings->gemeente = $request->gemeente;
        $verenigings->actief = 0;
        $verenigings->save();


        return response()->json([
            'type' => 'success',
            'text' => "De vereniging <b>$verenigings->naam</b> is toegevoegd!"
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Verenigings  $verenigings
     * @return \Illuminate\Http\Response
     */
    public function show(Verenigings $verenigings)
    {
        return redirect('admin/verenigingen');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Verenigings  $verenigings
     * @return \Illuminate\Http\Response
     */
    public function edit(Verenigings $verenigings)
    {
        $result = compact('verenigingen');
        return redirect('admin/verenigingen');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Verenigings $verenigings
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request, Verenigings $verenigings)
    {
        
        $data = $request->all();
        $verenigings = \App\Verenigings::find($id)->update([
            'naam' => $data['naam'],
            'rekeningnr' => $data['rekeningnr'],
            'hoofdverantwoordelijke' => $data['hoofdverantwoordelijke'],
            'btwnr' => $data['btwnr'],
            'straat' => $data['straat'],
            'huisnummer' => $data['huisnummer'],
            'postcode' => $data['postcode'],
            'gemeente' => $data['gemeente'],
        ]);

        return response()->json([
            'type' => 'success',
            'text' => "De vereniging is geupdatet!"
        ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Verenigings $verenigings
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Verenigings $verenigings)
    {

        $vereniging = \App\Verenigings::find($id)->delete();

        return response()->json([
            'type' => 'success',
            'text' => "De vereniging <b>$verenigings->naam</b> is verwijdert !"
        ]);
    }

    public function qryVerenigingen()
    {
        $verenigings = Verenigings::orderBy('id')
            ->get();
        return $verenigings;
    }

}
