<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Semakan extends Model
{
    protected $fillable = [
        'name', 'email', 'status'
    ];
}
