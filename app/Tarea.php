<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tarea extends Model
{
    protected $fillable=['archivo','nota','user_id','plan_id'];
}
