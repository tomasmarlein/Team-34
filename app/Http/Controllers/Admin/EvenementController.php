<?php

namespace App\Http\Controllers\Admin;

use App\Evenements;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EvenementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.evenementen.index');
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
     * @param  \App\Evenements  $evenements
     * @return \Illuminate\Http\Response
     */
    public function show(Evenements $evenements)
    {
        return redirect('admin/evenementen');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Evenements  $evenements
     * @return \Illuminate\Http\Response
     */
    public function edit(Evenements $evenements)
    {
        return redirect('admin/evenementen');

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Evenements  $evenements
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Evenements $evenements)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Evenements  $evenements
     * @return \Illuminate\Http\Response
     */
    public function destroy(Evenements $evenements)
    {
        //
    }

    public function qryEvenementen()
    {
        $evenementen = Evenements::orderBy('id')
            ->get();
        return $evenementen;
    }
}
