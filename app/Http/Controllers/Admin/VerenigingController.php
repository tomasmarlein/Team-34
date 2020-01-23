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

//        $naamVereniging = '%' . $request->input('naam');
//        $verenigingen = Verenigings::with('verenigings')
//            ->where('naam', 'like', $naamVereniging)
//            ->appends(['naam'=> $request->input('naam')]);

        return view('admin.verenigingen.index');
    }

    function fetch_data(Request $request)
    {

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return redirect('admin/verenigingen');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
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

        $vereniging = new Verenigings();
        $vereniging->naam = $request->naam;
        $vereniging->rekeningnr = $request->rekeningnr;
        $vereniging->hoofdverantwoordelijke = $request->hoofdverantwoordelijke;
        $vereniging->btwnr = $request->btwnr;
        $vereniging->straat = $request->straat;
        $vereniging->huisnummer = $request->huisnummer;
        $vereniging->postcode = $request->postcode;
        $vereniging->gemeente = $request->gemeente;
        $vereniging->save();
        return response()->json([
            'type' => 'success',
            'text' => "De vereniging <b>$vereniging->naam</b> is toegevoegd!"
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Verenigings  $vereniging
     * @return \Illuminate\Http\Response
     */
    public function show(Verenigings $vereniging)
    {
        return redirect('admin/verenigingen');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Verenigings  $vereniging
     * @return \Illuminate\Http\Response
     */
    public function edit(Vereniging $vereniging)
    {
        return redirect('admin/verenigingen');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Verenigings $vereniging
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, Verenigings $vereniging)
    {
        $this->validate($request,[
            'name' => 'required|min:3|unique:verenigingen,naam,' . $vereniging->id
        ]);
        $vereniging->naam = $request->naam;
        $vereniging->save();
        return response()->json([
            'type' => 'success',
            'text' => "De vereniging:  <b>$vereniging->naam</b> is geupdatet!"
        ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Verenigings $vereniging
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Verenigings $vereniging)
    {
        $vereniging->delete();
        session()->flash('success', "De vereniging:  <b>$vereniging->naam</b> is verwijdert!");
        return redirect('admin/verenigingen');
    }

    public function qryVerenigingen()
    {
        $verenigingen = Verenigings::orderBy('id')
            ->get();
        return $verenigingen;
    }

}
