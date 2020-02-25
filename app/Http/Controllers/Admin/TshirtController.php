<?php

namespace App\Http\Controllers\Admin;

use App\Gebruikers;
use App\Tshirt;
use App\tshirtType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TshirtController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.tshirt.index');
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
     * @param  \App\Tshirt  $tshirt
     * @return \Illuminate\Http\Response
     */
    public function show(Tshirt $tshirt)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tshirt  $tshirt
     * @return \Illuminate\Http\Response
     */
    public function edit(Tshirt $tshirt)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tshirt  $tshirt
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $data = $request->all();


        $tshirt = \App\Tshirt::find($id)->update([
            'maat' => $data['tshirt_maat'],
            'geslacht' => $data['tshirt_geslacht'],
            'aantal' => $data['tshirt_aantal'],
        ]);


        return response()->json([
            'type' => 'success',
            'text' => 'De vrijwilliger is aangepast!'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tshirt  $tshirt
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tshirt $tshirt)
    {
        //
    }

    public function qryTshirt()
    {
        $Tshirts = Gebruikers::orderBy('id')
            ->where('rolId', 3)
            ->orWhere('rolId', 4)
            ->with ('lid','tshirt')
            ->get();
        return $Tshirts;
    }

    public function qryTshirtTypes()
    {
        $Types = tshirtType::orderBy('type')
            ->get();
        return $Types;
    }
}
