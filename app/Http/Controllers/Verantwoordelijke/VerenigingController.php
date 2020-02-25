<?php

namespace App\Http\Controllers\Verantwoordelijke;

use App\Gebruikers;
use App\Verantwoordelijke;
use App\Verenigings;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;

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
        return redirect('verantwooderlijke/verenigingen');
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
            'naam' => 'required'
        ]);


        $gebruikers = new Gebruikers();
        $gebruikers->naam = $request->naam;
        $gebruikers->voornaam = $request->voornaam;
        $gebruikers->email = $request->email;

        if ($gebruikers->email = $request->email != null){
            $gebruikers->email = $request->email;
        }
        else {

            $gebruikers->email = "n/a";

        }

        if ( $gebruikers->telefoon = $request->telefoon != null){
            $gebruikers->telefoon = $request->telefoon;
        }
        else {

            $gebruikers->telefoon = "";

        }
            $gebruikers->geboortedatum = $request->geboortedatum;

        if($gebruikers->rijksregisternr = $request->rijksregisternr != null){
            $gebruikers->rijksregisternr = $request->rijksregisternr;

        }else{
            $gebruikers->rijksregisternr = "";

        }

        $gebruikers->opmerking =  $request->opermking;
        $gebruikers->rolId = 4;
        $gebruikers->save();

        $vereniging = Verenigings::orderby('id')
            ->where('hoofdverantwoordelijke', auth()->id())
            ->select('id')
            ->first();

        $gebruiker_id = Gebruikers::orderby('id','desc')
            ->first();

        \App\Gebruikers::find($gebruiker_id->id)->lid()->attach($vereniging->id);


        return view('verantwoordelijke.show');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Verantwoordelijke  $verantwoordelijke
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $verenigings = Verenigings::with('vereniginglid')->findOrFail($id);;
        $result = compact('vereniging');
        (new \App\Helpers\Json)->dump($result);
        return view('verantwoordelijke.show', $result);  // Pass $result to the view
    }

    public function showLeden($id)
    {
        $vereniging = Verenigings::with('vereniginglid')->findOrFail($id);;
        $result = compact('vereniging');
        (new \App\Helpers\Json)->dump($result);
        return view('verantwoordelijke.show', $result);  // Pass $result to the view
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Verantwoordelijke  $verantwoordelijke
     * @return \Illuminate\Http\Response
     */
    public function edit(Verantwoordelijke $verantwoordelijke)
    {
        return redirect('verantwooderlijke/verenigingen');

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Verantwoordelijke  $verantwoordelijke
     * @param  \App\Gebruikers  $gebruikers
     * @return \Illuminate\Http\Response
     */
    public function update($id,Request $request, Gebruikers $gebruikers)
    {
        $data = $request->all();
        $gebruiker = \App\Gebruikers::find($id)->update([
            'naam' => $data['naam'],
            'voornaam' => $data['voornaam'],
            'email' => $data['email'],
            'geboortedatum' => $data['geboortedatum'],
            'telefoon' => $data['telefoon'],
            'rijksregisternr' => $data['rijksregisternr'],
            'opmerking' => $data['opmerking'],
        ]);


        return response()->json([
            'type' => 'success',
            'text' => ' Het lid is aangepast!'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Verantwoordelijke  $verantwoordelijke
     * @param  \App\Gebruikers  $gebruikers

     * @return \Illuminate\Http\Response
     */
    public function destroy($id,Gebruikers $gebruikers)
    {
        $gebruikers->delete();

        $gebruiker = \App\Gebruikers::find($id)->delete();

        return response()->json([
            'type' => 'success',
            'text' => "De vrijwilliger <b>$gebruikers->naam $gebruikers->voornaam</b> is verwijderd!"
        ]);


    }

    public function qryVerenigingen()
    {

        $verenigingen = Verenigings::orderBy('naam')
            ->where(function ($query) {
                $query->where('hoofdverantwoordelijke', auth()->id())
                    ->orWhere('tweedeverantwoordelijke', auth()->id());
                       })
            ->get();
        return $verenigingen;
    }



    public function getVereniging()
    {

        $vereniging = Verenigings::orderBy('naam')
            ->where(function ($query) {
                $query->where('hoofdverantwoordelijke', auth()->id())
                    ->orWhere('tweedeverantwoordelijke', auth()->id());
            })
            ->get();
        return $vereniging;
    }




    public function randomOpmerking($lengte = 10) {
        $wachtwoord = array_merge(range('a', 'z'), range('A', 'Z'),range(0,9));
        shuffle($wachtwoord);
        return substr(implode($wachtwoord), 0, $lengte);
    }
}
