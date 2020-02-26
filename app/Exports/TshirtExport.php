<?php

namespace App\Exports;

use App\Tshirt;
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

class TshirtExport implements FromQuery, WithStrictNullComparison, WithHeadings, ShouldAutoSize, WithEvents, ShouldQueue, WithTitle
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
        return Tshirt::query()
            ->join('gebruikers', 'tshirts.gebruikers_id', '=', 'gebruikers.id')
            ->join('gebruikers_verenigings', 'gebruikers.id', '=', 'gebruikers_verenigings.gebruikers_id')
            ->join('verenigings', 'gebruikers_verenigings.verenigings_id', '=', 'verenigings.id')
            ->where([
                ['tshirts.maat', '!=', '0'],
                ['tshirts.geslacht', '!=', '0'],
                ['tshirts.aantal', '!=', '0'],
                ['verenigings.naam', $this->verenigingnaam]
            ])
            ->select('verenigings.naam as vnaam', 'gebruikers.naam as gnaam', 'gebruikers.voornaam as gvnaam','gebruikers.roepnaam as grnaam', 'tshirts.maat', 'tshirts.geslacht', 'tshirts.aantal');
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
            'Aantal'
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
