<?php

namespace App\Http\Controllers\Admin;


use App\Gebruikers;
use App\GebruikersVerenigings;
use App\Helpers\Json;
use App\Tshirt;
use App\Verenigings;
use foo\bar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use mysql_xdevapi\Result;
use Session;
use Validator;


class VerenigingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.verenigingen.index');
    }


    public function inaanvraag()
    {
        return redirect('admin.verenigingen.inaanvraag');
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
        return view('admin.verenigingen.create', $result);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'naam' => 'required',
            'rekeningnr' => 'required',
            'hoofdverantwoordelijke' => 'required',
            'btwnr' => 'required',
            'straat' => 'required',
            'huisnummer' => 'required',
            'postcode' => 'required',
            'gemeente' => 'required',
        ]);

        $verenigings = new Verenigings();
        $verenigings->naam = $request->naam;
        $verenigings->rekeningnr = $request->rekeningnr;
        $verenigings->hoofdverantwoordelijke = $request->hoofdverant;
        $verenigings->btwnr = $request->btwnr;
        $verenigings->straat = $request->straat;
        $verenigings->huisnummer = $request->huisnummer;
        $verenigings->postcode = $request->postcode;
        $verenigings->gemeente = $request->gemeente;
        $verenigings->actief = 0;
        $verenigings->save();


        return response()->json([
            'type' => 'success',
            'text' => "De vereniging <b>$verenigings->naam</b> is toegevoegd!"
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Verenigings $verenigings
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $vereniging = Verenigings::with('vereniginglid')->findOrFail($id);
        $result = compact('vereniging');
        (new \App\Helpers\Json)->dump($result);
        return view('admin.verenigingen.show', $result);  // Pass $result to the view
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Verenigings $verenigings
     * @return \Illuminate\Http\Response
     */
    public function edit(Verenigings $verenigings)
    {
        $result = compact('verenigingen');
        return redirect('admin/verenigingen');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Verenigings $verenigings
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request, Verenigings $verenigings)
    {


        $data = $request->all();
        $verenigings = \App\Verenigings::find($id)->update([
            'naam' => $data['naam'],
            'rekeningnr' => $data['rekeningnr'],
            'hoofdverantwoordelijke' => $data['hoofdverant'],
            'contactpersoon' => $data['hoofdverant'],
            'btwnr' => $data['btwnr'],
            'straat' => $data['straat'],
            'huisnummer' => $data['huisnummer'],
            'postcode' => $data['postcode'],
            'gemeente' => $data['gemeente'],
        ]);

        $replace = array('{"id":','}');
        $gebruiker = Gebruikers::find(str_replace($replace, "",$data['hoofdverant']));
        $gebruiker->lid()->attach(['verenigings_id' => $id]);

        return response()->json([
            'type' => 'success',
            'text' => "De vereniging is geupdatet!"
        ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Verenigings $verenigings
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Verenigings $verenigings)
    {

        $vereniging = \App\Verenigings::find($id)->delete();

        return response()->json([
            'type' => 'success',
            'text' => "De vereniging <b>$verenigings->naam</b> is verwijdert !"
        ]);
    }

    public function getAllVerenigingen()
    {
        $verenigings = Verenigings::orderBy('id')
            ->get();

        return $verenigings;
    }

    public function qryVerenigingen()
    {
        $verenigings = Verenigings::orderBy('actief', 'desc')
            ->where('inaanvraag', '=', 0)
            ->with('vereniginglid')
            ->get();

        return $verenigings;
    }


    public function getVerant()
    {
        $verant = Gebruikers::orderBy('id')
            ->where('rolId', '=', 3)
            ->get();

        return $verant;
    }


    public function qryVerenigingenInAanvraag()
    {
        $verenigings = Verenigings::orderBy('naam')
            ->where('inaanvraag', '=', 1)
            ->get();

        return $verenigings;
    }


    public function active($id, Verenigings $verenigings)
    {
        $actief = Verenigings::find($id)->update(['actief' => 1]);

        return redirect('admin/verenigingen');
    }


    public function approve($id, Verenigings $verenigings)
    {
        $inaanvraag = Verenigings::find($id);
        if ($verenigings->inaanvraag !== 0) {
            $inaanvraag->update(['inaanvraag' => 0]);
        }
        return redirect('admin/verenigingen');
    }


    public function nonactive($id, Verenigings $verenigings)
    {
        $actief = Verenigings::find($id)->update(['actief' => 0]);

        return redirect('admin/verenigingen');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function verenigingAanvragen(Request $request)
    {
        $this->validate($request, [
            'naam' => 'required',
            'voornaam' => 'required',
            'email' => 'required',
        ]);


        $gegenereerdWachtwoord = $this->randomWachtwoord();


        $gebruikers = new Gebruikers();
        Session::put('gebruikersnaam',$gebruikers->naam = $request->naam);
        Session::put('gebruikersvoornaam',$gebruikers->voornaam = $request->voornaam);
        Session::put('gebruikersemail',$gebruikers->email = $request->email);
        Session::put('gebruikerstelefoon',$gebruikers->telefoon = $request->telefoon);
        Session::put('gebruikersgeboortedatum',$gebruikers->geboortedatum = $request->geboortedatum);
        Session::put('rijksregisternr',$gebruikers->rijksregisternr = $request->rijksregisternr);
        Session::put('rollId',$gebruikers->rolId = 3);
        Session::put('opmerking',$gebruikers->opmerking = $gegenereerdWachtwoord);
        Session::put('password',$gebruikers->password = \Hash::make($gegenereerdWachtwoord));

        $result = compact('gebruikers');
        return view('aanvragen.aanvraag',$result);

    }


    public function verenigingAanvragenNext(Request $request)
    {
        $this->validate($request, [
            'naam' => 'required',
            'rekeningnr' => 'required',
        ]);

        $verenigings = new Verenigings();

        $replace = array('{"id":','}');

        $gebruiker_id = Gebruikers::orderby('id')
            ->where('rijksregisternr', Session::get('rijksregisternr'))
            ->select('id')
            ->first();

        Session::put('verenigingssnaam',$verenigings->naam = $request->naam);
        Session::put('verenigingsrekeningnr',$verenigings->rekeningnr = $request->rekeningnr);
        Session::put('verenigingsbtwnr',$verenigings->btwnr = $request->btwnr);
        Session::put('verenigingsstraat',$verenigings->straat = $request->straat);
        Session::put('verenigingshuisnummer',$verenigings->huisnummer = $request->huisnummer);
        Session::put('verenigingspostcode',$verenigings->postcode = $request->postcode);
        Session::put('verenigingsgemeente',$verenigings->gemeente = $request->gemeente);
        Session::put('verenigingsactief',$verenigings->actief = 0);
        Session::put('inaanvraag',$verenigings->inaanvraag = 1);
        Session::put('verenigingshoofdverantwoordelijke',   $verenigings->hoofdverantwoordelijke =  str_replace($replace, "",$gebruiker_id));

        $result = compact('verenigings');
        return view('aanvragen.bevestiging',$result);

    }


    public function aanvraagBevestigen(Request $request){

        $verenigings = new Verenigings();
        $gebruikers = new Gebruikers();

        $gebruikers->naam = Session::get('gebruikersnaam');
        $gebruikers->voornaam = Session::get('gebruikersvoornaam');
        $gebruikers->email = Session::get('gebruikersemail');
        $gebruikers->telefoon = Session::get('gebruikerstelefoon');
        $gebruikers->geboortedatum = Session::get('gebruikersgeboortedatum');
        $gebruikers->rijksregisternr = Session::get('rijksregisternr');
        $gebruikers->rolId = Session::get('rollId');
        $gebruikers->password =  Session::get('password');
        $gebruikers->opmerking = Session::get('opmerking');

        $gebruikers->save();

        $gebruiker_id = Gebruikers::orderby('id')
            ->where('rijksregisternr', Session::get('rijksregisternr'))
            ->select('id')
            ->first();

        $tshirt = new Tshirt();
        $tshirt->maat = 0;
        $tshirt->geslacht = 0;
        $tshirt->aantal = 0;
        $tshirt->gebruikers_id = $gebruiker_id->id;
        $tshirt->save();

        $verenigings->naam = Session::get('verenigingssnaam');
        $verenigings->rekeningnr = Session::get('verenigingsrekeningnr');
        $verenigings->btwnr = Session::get('verenigingsbtwnr');
        $verenigings->straat = Session::get('verenigingsstraat');
        $verenigings->huisnummer = Session::get('verenigingshuisnummer');
        $verenigings->postcode = Session::get('verenigingspostcode');
        $verenigings->gemeente = Session::get('verenigingsgemeente');
        $verenigings->actief = Session::get('verenigingsactief');
        $verenigings->inaanvraag = Session::get('inaanvraag');

        $replace = array('{"id":','}');
        $verenigings->hoofdverantwoordelijke =  str_replace($replace, "",$gebruiker_id);;

        $verenigings->save();

        $gebruiker = Gebruikers::find(str_replace($replace, "",$gebruiker_id));
        $gebruiker->lid()->sync(['verenigings_id' => $verenigings->id], ['gebruikers_id' => $gebruiker_id]);



        return view('aanvragen.aanvraagvoltooid');
    }


    public function aanvraagVoltooid(Request $request){
        $request->session()->flush();
        return view('landingpage');
    }




    public function randomWachtwoord($lengte = 10) {
        $wachtwoord = array_merge(range('a', 'z'), range('A', 'Z'),range(0,9));
        shuffle($wachtwoord);
        return substr(implode($wachtwoord), 0, $lengte);
    }
}
