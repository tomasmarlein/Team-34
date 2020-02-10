<?php

namespace App\Imports;

use App\Gebruikers;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class GebruikersImport implements ToCollection, WithHeadingRow, WithChunkReading
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
            Gebruikers::create([
                'email' => $row['email'],
                'naam' => $row['naam'],
                'voornaam' => $row['voornaam'],
                'roepnaam' => $row['roepnaam'],
                'straat' => $row['straat'],
                'huisnummer' => $row['huisnummer'],
                'geboortedatum' => $row['geboortedatum'],
                'telefoon' => $row['telefoon'],
                'tweedetshirt' => $row['tweedeshirt'],
                'opmerking' => $row['opmerking'],
                'rijksregisternr' => $row['rijksregisternr'],
                'postcode' => $row['postcode'],
                'lunchpakket' => $row['lunchpakket'],
                'tshirtId' => $row['tshirt'],
                'rolId' => 4
            ]);
        }
    }

    public function chunkSize(): int
    {
        return 500;
    }
}
