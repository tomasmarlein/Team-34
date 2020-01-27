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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $verenigingen = new Verenigings();
        $result = compact('verenigingen');
        return redirect('admin.verenigingen.create',$result);
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
//            'rekeningnr' => 'min:3|unique:verenigingen,rekeningnr',
//            'hoofdverantwoordelijke' => 'min:3|unique:verenigingen,hoofdverantwoordelijke',
//            'btwnr' => 'min:3|unique:verenigingen,btwnr',
//            'straat' => 'min:3|unique:verenigingen,straat',
//            'huisnummer' => 'min:3|unique:verenigingen,huisnummer',
//            'postcode' => 'min:3|unique:verenigingen,postcode',
//            'gemeente' => 'min:3|unique:verenigingen,gemeente'
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
    public function update($id, Request $request, Verenigings $vereniging)
    {

        $data = $request->all();
        $vereniging = \App\Verenigings::find($id)->update([
            'naam' => $data['naam'],
        ]);


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
    public function destroy($id, Verenigings $vereniging)
    {
//        $vereniging->delete();
//        session()->flash('success', "De vereniging:  <b>$vereniging->naam</b> is verwijdert!");
//        return redirect('admin/verenigingen');



        $vereniging = \App\verenigins::find($id)->delete();
        return response()->json([
            'type' => 'success',
            'text' => "De vereniging <b>$vereniging->naam</b> is verwijdert !"
        ]);
    }

    public function qryVerenigingen()
    {
        $verenigingen = Verenigings::orderBy('id')
            ->get();
        return $verenigingen;
    }

}
