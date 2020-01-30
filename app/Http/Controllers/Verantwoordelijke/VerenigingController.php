<?php

namespace App\Http\Controllers\Verantwoordelijke;

use App\Verantwoordelijke;
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
        return view('verantwoordelijke.vereniging');
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
     * @param  \App\Verantwoordelijke  $verantwoordelijke
     * @return \Illuminate\Http\Response
     */
    public function show(Verantwoordelijke $verantwoordelijke)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Verantwoordelijke  $verantwoordelijke
     * @return \Illuminate\Http\Response
     */
    public function edit(Verantwoordelijke $verantwoordelijke)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Verantwoordelijke  $verantwoordelijke
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Verantwoordelijke $verantwoordelijke)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Verantwoordelijke  $verantwoordelijke
     * @return \Illuminate\Http\Response
     */
    public function destroy(Verantwoordelijke $verantwoordelijke)
    {
        //
    }

    public function qryVerenigingen()
    {

        $verenigingen = Verenigings::orderBy('naam')
            ->where(function ($query) {
                $query->where('hoofdverantwoordelijke', auth()->id())
                    ->orWhere('tweedeverantwoordelijke', auth()->id())
                       })
            ->get();
        return $verenigingen;
    }
}
