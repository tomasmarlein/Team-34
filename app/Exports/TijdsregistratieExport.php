<?php

namespace App\Exports;

use App\Tijdsregistratie;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;

class TijdsregistratieExport implements FromQuery, WithStrictNullComparison, WithHeadings, ShouldAutoSize, WithEvents, ShouldQueue, WithTitle
{
    use Exportable;
    /**
     * @return \Illuminate\Support\Collection
     */

    private $verenigingnaam;

    public function __construct(string $verenigingnaam)
    {
        $this->verenigingnaam = $verenigingnaam;
    }

    public function query()
    {
        return Tijdsregistratie::query()
            ->join('gebruikers', 'tijdsregistraties.gebruikers_id', '=', 'gebruikers.id')
            ->join('verenigings', 'tijdsregistraties.verenigings_id', '=', 'verenigings.id')
            ->where('verenigings.naam', $this->verenigingnaam)
            ->select('verenigings.naam as vnaam', 'gebruikers.naam as gnaam', 'gebruikers.voornaam as gvnaam','gebruikers.roepnaam as grnaam' ,'checkIn', 'checkUit', 'manCheckIn', 'manCheckUit', 'adminCheckIn', 'adminCheckUit');

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
            'Check in',
            'Check uit',
            'Manuele check in',
            'Manuele check uit',
            'Admin check in',
            'Admin check uit'
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
        return $this->verenigingnaam;
    }
}