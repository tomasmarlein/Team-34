<?php

namespace App\Exports;

use App\Gebruikers;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithEvents;

class VrijwilligersExport implements FromQuery, WithStrictNullComparison, WithHeadings, ShouldAutoSize, WithEvents, ShouldQueue
{
    use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */

    public function query()
    {
        return Gebruikers::query()
            ->with('lid')
            ->where('rolId', 4)
            ->select( 'email', 'naam', 'voornaam', 'roepnaam', 'geboortedatum', 'telefoon', 'tweedetshirt', 'opmerking', 'rijksregisternr', 'lunchpakket', 'tshirtId');
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'Vereniging',
            'E-mail',
            'Naam',
            'Voornaam',
            'Roepnaam',
            'Geboortedatum',
            'Telefoon',
            '2de T-shirt',
            'Opmerking',
            'Rijksregisternr',
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
