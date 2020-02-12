<?php

namespace App\Http\Controllers\Admin;

use App\Exports\VrijwilligersExport;
use App\Imports\VrijwilligersImport;
use App\Gebruikers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

class VrijwilligerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function import()
    {
        Excel::import(new VrijwilligersImport(),request()->file('file'));

        return back();
    }

    public function export()
    {
        return Excel::download(new VrijwilligersExport(), 'Vrijwillers.xlsx');
    }

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
        return redirect('admin/vrijwilligers');
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
        $gebruikers->voornaam = $request->voornaam;
        $gebruikers->email = $request->email;
        $gebruikers->telefoon = $request->telefoon;
        $gebruikers->geboortedatum = $request->geboortedatum;
        $gebruikers->rolId = 4;
//        $gebruikers->password = Hash::make("gladiolen");
        $gebruikers->save();

        return response()->json([
            'type' => 'success',
            'text' => "De gebruiker <b>$gebruikers->name</b> is toegevoegd"
        ]);

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
        return redirect('admin/vrijwilligers');
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
            'voornaam' => $data['voornaam'],
            'roepnaam' => $data['roepnaam'],
            'email' => $data['email'],
            'geboortedatum' => $data['geboortedatum'],
            'telefoon' => $data['telefoon'],
        ]);


        return response()->json([
            'type' => 'success',
            'text' => 'De vrijwilliger is aangepast!'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Gebruikers  $gebruikers
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Gebruikers $gebruikers)
    {
//        $gebruikers->delete();

        $gebruiker = \App\Gebruikers::find($id)->delete();


        return response()->json([
            'type' => 'success',
            'text' => "De vrijwilliger <b>$gebruikers->naam $gebruikers->voornaam</b> is verwijderd!"
        ]);
    }




    public function qryVrijwilligers(Request $request)
    {
        $naam = '%' . $request->input('name') . '%';

        $gebruikers = Gebruikers::orderBy('id')
                ->where('rolId', '=', 4)
                ->where('naam', 'like', 'Vrijwilliger_0')
                ->with ('lid')
                ->get();
            return $gebruikers;
    }


//    public function qryVrijwilligers()
//    {
//        $gebruikers = Gebruikers::orderBy('id')
//            ->where('rolId', '=', 4)
//            ->with ('lid')
//            ->get();
//        return $gebruikers;
//    }
}
