<?php

namespace App\Exports;

use App\Tshirt;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class HeadTshirtExport implements WithMultipleSheets
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $sheets;

    public function sheets(): array
    {
        $verenigingen = \App\Verenigings::all();

        foreach($verenigingen as $vereniging){
            $sheets[] = new TshirtExport($vereniging->naam);
        }

        return $sheets;
    }
}
