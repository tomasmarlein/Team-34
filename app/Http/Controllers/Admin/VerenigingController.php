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
            'naam' => 'required|min:3|unique:verenigingen,naam',
            'rekeningnr' => 'min:3|unique:verenigingen,rekeningnr',
            'hoofdverantwoordelijke' => 'min:3|unique:verenigingen,hoofdverantwoordelijke',
            'btwnr' => 'min:3|unique:verenigingen,btwnr',
            'straat' => 'min:3|unique:verenigingen,straat',
            'huisnummer' => 'min:3|unique:verenigingen,huisnummer',
            'postcode' => 'min:3|unique:verenigingen,postcode',
            'gemeente' => 'min:3|unique:verenigingen,gemeente'
        ]);

        $verenigingen = new Verenigings();
        $verenigingen->naam = $request->naam;
        $verenigingen->rekeningnr = $request->rekeningnr;
        $verenigingen->hoofdverantwoordelijke = $request->hoofdverantwoordelijke;
        $verenigingen->btwnr = $request->btwnr;
        $verenigingen->straat = $request->straat;
        $verenigingen->huisnummer = $request->huisnummer;
        $verenigingen->postcode = $request->postcode;
        $verenigingen->gemeente = $request->gemeente;
        $verenigingen->save();
        return response()->json([
            'type' => 'success',
            'text' => "De vereniging <b>$verenigingen->naam</b> is toegevoegd!"
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Verenigings  $verenigingen
     * @return \Illuminate\Http\Response
     */
    public function show(Verenigings $verenigingen)
    {
        return redirect('admin/verenigingen');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Verenigings  $verenigingen
     * @return \Illuminate\Http\Response
     */
    public function edit(Verenigings $verenigingen)
    {
        $result = compact('verenigingen');
        return redirect('admin/verenigingen');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Verenigings $verenigingen
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request, Verenigings $verenigingen)
    {

        $data = $request->all();
        $verenigingen = \App\Verenigings::find($id)->update([
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
            'text' => "De vereniging:  <b>$verenigingen->naam</b> is geupdatet!"
        ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Verenigings $verenigingen
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Verenigings $verenigingen)
    {

        $vereniging = \App\Verenigings::find($id)->delete();
        return response()->json([
            'type' => 'success',
            'text' => "De vereniging <b>$verenigingen->naam</b> is verwijdert !"
        ]);
    }

    public function qryVerenigingen()
    {
        $verenigingen = Verenigings::orderBy('id')
            ->get();
        return $verenigingen;
    }

}
