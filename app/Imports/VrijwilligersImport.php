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
        $teller = 1;
        $fp = fopen('importLog.txt', 'w');
        foreach ($rows as $row)
        {
            $teller++;

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
                        if($row['geslacht'] != null){
                            if($row['aantal'] != null){
                                Tshirt::create([
                                    'maat' => $row['maat'],
                                    'geslacht' => $row['geslacht'],
                                    'aantal' => $row['aantal'],
                                    'gebruikers_id' => $gebruiker_id->id
                                ]);
                            } else{
                                fwrite($fp, 'Het aantal tshirts van gebruiker "');
                                fwrite($fp, $row['naam'] . ' ' . $row['voornaam']);
                                fwrite($fp, '" op rij ');
                                fwrite($fp, $teller . ' heeft geen aantal' . "\n");
                            }
                        } else{
                            fwrite($fp, 'Het geslacht van gebruiker "');
                            fwrite($fp, $row['naam'] . ' ' . $row['voornaam']);
                            fwrite($fp, '" op rij ');
                            fwrite($fp, $teller . ' mist een geslacht voor het tshirt' . "\n");
                        }
                    } else {
                        fwrite($fp, 'Als de gebruiker "');
                        fwrite($fp, $row['naam'] . ' ' . $row['voornaam']);
                        fwrite($fp, '" op rij ');
                        fwrite($fp, $teller . ' een tshirt wilt, moet je deze nog handmatig een maat toewijzen' . "\n");
                    }

                    \App\Gebruikers::find($gebruiker_id->id)->lid()->attach($verId->id);

                } else {
                    fwrite($fp, 'Het rijksregisternummer "');
                    fwrite($fp, $row['rijksregisternr']);
                    fwrite($fp, '" op rij ');
                    fwrite($fp, $teller);
                    fwrite($fp, ' bestaat al in de database of het is leeg in de excel.' . "\n");
                }
            } else {
                fwrite($fp, 'De vereniging "');
                fwrite($fp, $row['vereniging']);
                fwrite($fp, '" op rij ');
                fwrite($fp, $teller);
                fwrite($fp, ' bestaat nog niet in de database.' . "\n");
            }
        }
        fclose($fp);
    }

    public function chunkSize(): int
    {
        return 500;
    }
}
