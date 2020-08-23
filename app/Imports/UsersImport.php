<?php

namespace App\Imports;

use App\User;
use Illuminate\Support\Facades\Hash;

use Maatwebsite\Excel\Concerns\ToModel;

class UsersImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new User([
//            'id'     => $row[0],
            'name'     => $row[0],
            'email'    => $row[1],
            'tipo'    => 'teacher',
            'password' => Hash::make('123456'),
        ]);
    }
}
