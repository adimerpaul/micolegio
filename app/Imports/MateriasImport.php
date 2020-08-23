<?php

namespace App\Imports;

use App\Materia;
use Maatwebsite\Excel\Concerns\ToModel;

class MateriasImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Materia([
            'nombre'     => $row[0],
        ]);
    }
}
