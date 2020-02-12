<?php

namespace App\Exports;

use App\Gebruikers;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;

class VrijwilligerTshirtExport implements FromQuery, WithStrictNullComparison, WithHeadings, ShouldAutoSize, WithEvents, WithTitle
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function query()
    {
        return Gebruikers::query()
            ->join('gebruikers_verenigings', 'gebruikers.id', '=', 'gebruikers_verenigings.gebruikers_id')
            ->join('verenigings', 'gebruikers_verenigings.verenigings_id', '=', 'verenigings.id')
            ->join('tshirts', 'gebruikers.id', '=', 'tshirts.gebruikers_id')
            ->leftJoin('tshirt_types', 'tshirts.types_id', '=', 'tshirt_types.id')
            ->where('rolId', 4)
            ->select( 'verenigings.naam as vnaam', 'gebruikers.naam', 'gebruikers.voornaam', 'gebruikers.roepnaam', 'tshirts.maat', 'tshirts.geslacht', 'tshirts.aantal', 'tshirt_types.type');
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'Vereniging',
            'Naam',
            'Voornaam',
            'Roepnaam',
            'Maat',
            'Geslacht',
            'Aantal',
            'Type'
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

    public function title(): string
    {
        return 'Tshirts';
    }
}
