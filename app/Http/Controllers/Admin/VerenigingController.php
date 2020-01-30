<?php

namespace App\Http\Controllers\Admin;


use App\Gebruikers;
use App\Helpers\Json;
use App\Verenigings;
use foo\bar;
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
        $verenigings->hoofdverantwoordelijke = $request->hoofdverantwoordelijke;
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
        $vereniging = Verenigings::with('vereniginglid')->findOrFail($id);;
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
            'hoofdverantwoordelijke' => $data['hoofdverantwoordelijke'],
            'btwnr' => $data['btwnr'],
            'straat' => $data['straat'],
            'huisnummer' => $data['huisnummer'],
            'postcode' => $data['postcode'],
            'gemeente' => $data['gemeente'],
        ]);

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
        ]);

        $gebruikers = new Gebruikers();
        $gebruikers->naam = $request->naam;
        $gebruikers->voornaam = $request->voornaam;
        $gebruikers->email = $request->email;
        $gebruikers->straat = $request->straat;
        $gebruikers->huisnummer = $request->huisnummer;
        $gebruikers->postcode = $request->postcode;
        $gebruikers->telefoon = $request->telefoon;
        $gebruikers->geboortedatum = $request->geboortedatum;
        $gebruikers->rolId = 3;
        $gebruikers->password = \Hash::make("azerty123");;
        $gebruikers->save();

        $result = compact('gebruikers');
        return view('aanvragen.aanvraag',$result);

    }


    public function verenigingAanvragenNext(Request $request)
    {
//        $this->validate($request, [
//            'verenigingnaam' => 'required',
//            'rekeningnr' => 'required',
//            'btwnr' => 'required',
//        ]);

        $verenigings = new Verenigings();

        $verenigings->naam = $request->naam;
        $verenigings->rekeningnr = $request->rekeningnr;
        $verenigings->btwnr = $request->btwnr;
        $verenigings->straat = $request->straat;
        $verenigings->hoofdverantwoordelijke = $request->hoofdverantwoordelijke;
        $verenigings->huisnummer = $request->huisnummer;
        $verenigings->postcode = $request->postcode;
        $verenigings->gemeente = $request->gemeente;
        $verenigings->actief = 0;
        $verenigings->inaanvraag = 1;
        $verenigings->save();


        $result = compact('verenigings');
        return view('landingpage',$result);

    }


}
