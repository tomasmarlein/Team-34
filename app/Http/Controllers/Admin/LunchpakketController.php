<?php

namespace App\Http\Controllers\Admin;

use App\Gebruikers;
use App\Lunchpakket;
use Facades\App\Helpers\Json;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LunchpakketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $lunchpakket = Gebruikers::with ('lid')
            ->where('lunchpakket',true)
            ->get();
        $result = compact('lunchpakket');
        Json::dump($result);

        return view('admin.lunchpakket.index', $result);
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
     * @param  \App\Lunchpakket  $lunchpakket
     * @return \Illuminate\Http\Response
     */
    public function show(Lunchpakket $lunchpakket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Lunchpakket  $lunchpakket
     * @return \Illuminate\Http\Response
     */
    public function edit(Lunchpakket $lunchpakket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Lunchpakket  $lunchpakket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lunchpakket $lunchpakket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Lunchpakket  $lunchpakket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lunchpakket $lunchpakket)
    {
        //
    }

}
