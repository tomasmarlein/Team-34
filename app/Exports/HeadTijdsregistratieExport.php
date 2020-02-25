<?php

namespace App\Exports;

use App\Tijdsregistratie;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class HeadTijdsregistratieExport implements WithMultipleSheets
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $sheets;

    public function sheets(): array
    {
        $verenigingen = \App\Verenigings::all();

        foreach($verenigingen as $vereniging){
            $sheets[] = new TijdsregistratieExport($vereniging->naam);
        }

        return $sheets;
    }
}
