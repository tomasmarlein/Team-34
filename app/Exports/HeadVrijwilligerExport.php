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

        $sheets[]= new VrijwilligersExport('Info', 'Info');
        $sheets[] = new VrijwilligerTshirtExport('Tshirt', 'Tshirt');

        return $sheets;
    }
}
