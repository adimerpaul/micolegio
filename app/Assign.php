<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Assign extends Model
{
    protected $fillable=['user_id','curso_id','materia_id'];
}
