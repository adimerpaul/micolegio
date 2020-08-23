<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $fillable=['nombre','tipo','estado','nota','archivo','assign_id','enviado'];
}
