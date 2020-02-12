<?php

namespace App\Imports;

use App\Gebruikers;
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

            $verenigingnaam = Verenigings::orderBy('naam')
                ->where('naam', $row['vereniging'])
                ->select('naam');


            $gebruiker = Gebruikers::orderBy('naam')
                ->where([
                    ['naam', '=', $row['naam']],
                    ['voornaam', '=', $row['voornaam']],
                    ['geboortedatum', '=', $datum->format('Y-m-d')]])
                ->select('naam');

            $n = Gebruikers::find($row['naam']);
            $v = Gebruikers::find($row['voornaam']);
            $d = Gebruikers::find($datum->format('Y-m-d'));

            if($verenigingnaam != null){
                if(empty($n) && empty($v) && empty($d)){
                    dd('kies ma');
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
                } else {
                    dd('nope');

//                    $gebruiker_id = Gebruikers::orderBy('id', 'desc')
//                        ->first()
//                        ->select('id');

//                    $verId = Verenigings::orderBy('naam')
//                        ->where('naam', '=', $row['vereniging'])
//                        ->select('id');

                    //$gebruiker = Gebruikers::find($gebruiker_id);

                    //$gebruiker->lid()->sync(['verenigings_id' => $verId], ['gebruikers_id' => $gebruiker_id]);
                }
            }
        }
    }

    public function chunkSize(): int
    {
        return 500;
    }
}
