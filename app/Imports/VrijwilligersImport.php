<?php

namespace App\Imports;

use App\Gebruikers;
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
            Gebruikers::create([
                'email' => $row['email'],
                'naam' => $row['naam'],
                'voornaam' => $row['voornaam'],
                'roepnaam' => $row['roepnaam'],
                'geboortedatum' => $row['geboortedatum'],
                'telefoon' => $row['telefoon'],
                'opmerking' => $row['opmerking'],
                'rijksregisternr' => $row['rijksregisternr'],
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
