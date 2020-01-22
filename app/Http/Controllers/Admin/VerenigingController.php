<?php

namespace App\Http\Controllers\Admin;

use App\Vereniging;
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
        return view('admin.vereniging.index');
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
            'naam' => 'required|min:3|unique:verenigingen,naam'
        ]);

        $vereniging = new Vereniging();
        $vereniging->naam = $request->naam;
        $vereniging->save();
        return response()->json([
            'type' => 'success',
            'text' => "De vereniging <b>$vereniging->naam</b> is toegevoegd!"
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Vereniging  $vereniging
     * @return \Illuminate\Http\Response
     */
    public function show(Vereniging $vereniging)
    {
        return redirect('admin/verenigingen');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Vereniging  $vereniging
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
     * @param \App\Vereniging $vereniging
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, Vereniging $vereniging)
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
     * @param  \App\Vereniging  $vereniging
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vereniging $vereniging)
    {
        $vereniging->delete();
        session()->flash('success', "De vereniging:  <b>$vereniging->naam</b> is verwijdert!");
        return redirect('admin/verenigingen');
    }

    public function qryVerenigingen()
    {
        $verenigingen = Vereniging::orderBy('naam')
            ->get();
        return $verenigingen;
    }

}
