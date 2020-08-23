<?php

namespace App\Imports;

use App\Curso;
use Maatwebsite\Excel\Concerns\ToModel;

class CursosImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Curso([
            'nombre'     => $row[0],
            'abreviatura'     => $row[1],
            'encargado'     => $row[2],
        ]);
    }
}
