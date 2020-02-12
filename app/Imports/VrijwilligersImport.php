<?php

namespace App\Imports;

use App\Gebruikers;
use App\Tshirt;
use App\Verenigings;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class VrijwilligersImport implements ToCollection, WithHeadingRow, WithChunkReading
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row)
        {
            $datum = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['geboortedatum']);

            $verenigingnaams = \App\Verenigings::where('naam',$row['vereniging'])->first();
            $rijks = \App\Gebruikers::where('rijksregisternr', $row['rijksregisternr'])->first();


            if($verenigingnaams != null){
                if($rijks == null){
                    Gebruikers::create([
                        'email' => $row['email'],
                        'naam' => $row['naam'],
                        'voornaam' => $row['voornaam'],
                        'roepnaam' => $row['roepnaam'],
                        'geboortedatum' => $datum->format('Y-m-d'),
                        'telefoon' => $row['telefoon'],
                        'opmerking' => $row['opmerking'],
                        'rijksregisternr' => $row['rijksregisternr'],
                        'lunchpakket' => $row['lunchpakket'],
                        'rolId' => 4
                    ]);

                    $gebruiker_id = \App\Gebruikers::orderBy('id', 'desc')->first();
                    $verId = \App\Verenigings::where('naam', $row['vereniging'])->first();

                    if($row['maat'] != null){
                        Tshirt::create([
                            'maat' => $row['maat'],
                            'geslacht' => $row['geslacht'],
                            'aantal' => $row['aantal'],
                            'gebruikers_id' => $gebruiker_id->id
                        ]);
                    }

                    \App\Gebruikers::find($gebruiker_id->id)->lid()->attach($verId->id);

                }
            }
        }
    }

    public function chunkSize(): int
    {
        return 500;
    }
}
