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
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithEvents;

class VrijwilligersExport implements FromQuery, WithStrictNullComparison, WithHeadings, ShouldAutoSize, WithEvents, ShouldQueue, WithTitle
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
        return Gebruikers::query()
            ->join('gebruikers_verenigings', 'gebruikers.id', '=', 'gebruikers_verenigings.gebruikers_id')
            ->join('verenigings', 'gebruikers_verenigings.verenigings_id', '=', 'verenigings.id')
            ->where('verenigings.naam', $this->verenigingnaam)
            ->select( 'verenigings.naam as vnaam','gebruikers.email', 'gebruikers.naam', 'gebruikers.voornaam', 'gebruikers.roepnaam', 'gebruikers.geboortedatum', 'gebruikers.telefoon', 'gebruikers.opmerking', 'gebruikers.rijksregisternr', 'gebruikers.lunchpakket');

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
            'Opmerking',
            'Rijksregisternr',
            'Lunchpakket (0=geen, 1=wel)',
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
