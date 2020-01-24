<?php

namespace App\Http\Controllers\Admin;

use App\Gebruikers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VrijwilligerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.vrijwilligers.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $gebruikers = new Gebruikers();
        $result = compact('gebruikers');
        return view('admin.vrijwilligers.create', $result);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'naam' => 'required|min:3|unique:gebruikers,naam'
        ]);

        $gebruikers = new Gebruikers();
        $gebruikers->naam = $request->naam;
        $gebruikers->save();
        session()->flash('success', "De vrijwilliger <b>$gebruikers->naam</b> has been added");
        return redirect('admin/vrijwilligers');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Gebruikers  $gebruikers
     * @return \Illuminate\Http\Response
     */
    public function show(Gebruikers $gebruikers)
    {
        return redirect('admin/vrijwilligers');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Gebruikers  $gebruikers
     * @return \Illuminate\Http\Response
     */
    public function edit(Gebruikers $gebruikers)
    {
        $result = compact('gebruikers');
        return view('admin.vrijwilligers.edit', $result);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Gebruikers  $gebruikers
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request, Gebruikers $gebruikers)
    {
        $data = $request->all();
        $gebruiker = \App\Gebruikers::find($id)->update([
            'naam' => $data['naam'],
        ]);


        return response()->json([
            'type' => 'success',
            'text' => "The vrijwilliger <b>$gebruikers->name</b> is geupdate"
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Gebruikers  $gebruikers
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gebruikers $gebruikers)
    {
        $gebruikers->delete();
        return response()->json([
            'type' => 'success',
            'text' => "De vrijwilliger <b>$gebruikers->naam $gebruikers->voornaam</b> is verwijderd!"
        ]);
    }

    public function qryVrijwilligers()
    {
        $gebruikers = Gebruikers::orderBy('naam')
            ->get();
        return $gebruikers;
    }
}
