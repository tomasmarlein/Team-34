<?php

namespace App\Http\Controllers\Admin;

use App\Gebruikers;
use App\verantwoordlijke;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VerantwoordelijkeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.verantwoordelijke.verantwoordelijkebeheer');
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
     * @param  \App\verantwoordlijke  $verantwoordlijke
     * @return \Illuminate\Http\Response
     */
    public function show(verantwoordlijke $verantwoordlijke)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\verantwoordlijke  $verantwoordlijke
     * @return \Illuminate\Http\Response
     */
    public function edit(verantwoordlijke $verantwoordlijke)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\verantwoordlijke  $verantwoordlijke
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, verantwoordlijke $verantwoordlijke)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\verantwoordlijke  $verantwoordlijke
     * @return \Illuminate\Http\Response
     */
    public function destroy(verantwoordlijke $verantwoordlijke)
    {
        //
    }

    public function qryVerantwoordelijke()
    {
        $verantwoordelijke = Gebruikers::orderBy('naam')
            ->where('rolId', '=', 1)
            ->get();
        return $verantwoordelijke;
    }
}
