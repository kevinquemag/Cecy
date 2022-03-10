<?php

namespace App\Imports;

use App\Models\Cecy\Certificate;
use Maatwebsite\Excel\Concerns\ToModel;

class CertificatesImport implements ToModel
{
   /** 
    * @param array $row
    * @return \Illuminate\Database\Eloquent\Model|null

*/

public function model(array $row)
{   
    return new Certificate([
        'code' => $row['0'],
        'issued_at' => $row['1'],
    ]);
}




}
