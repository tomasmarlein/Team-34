<?php

namespace App\Exports;

use App\Gebruikers;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithEvents;

class GebruikesExport implements FromQuery, WithStrictNullComparison, WithHeadings, ShouldAutoSize, WithEvents
{
    use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */

    public function query()
    {
        return Gebruikers::query()->where('rolId', 4)->select('email', 'naam', 'voornaam', 'roepnaam', 'straat', 'huisnummer', 'geboortedatum', 'telefoon', 'tweedetshirt', 'opmerking', 'rijksregisternr', 'postcode', 'lunchpakket', 'tshirtId');
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'E-mail',
            'Naam',
            'Voornaam',
            'Roepnaam',
            'Straat',
            'Huisnummer',
            'Geboortedatum',
            'Telefoon',
            '2de T-shirt',
            'Opmerking',
            'Rijksregisternr',
            'Postcode',
            'Lunchpakket',
            'T-Shirt'
        ];
    }

    /**
     * @return array
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $cellRange = 'A1:N1'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(14);
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setBold(true);
            },
        ];
    }
}
