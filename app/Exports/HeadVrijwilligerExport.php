<?php

namespace App\Exports;

use App\Gebruikers;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class HeadVrijwilligerExport implements WithMultipleSheets
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $sheets;

    public function sheets(): array
    {
        $verenigingen = \App\Verenigings::all();

        foreach($verenigingen as $vereniging){
            $sheets[] = new VrijwilligersExport($vereniging->naam);
        }

        return $sheets;
    }
}
