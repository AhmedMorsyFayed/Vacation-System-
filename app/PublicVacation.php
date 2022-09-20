<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PublicVacation extends Model
{
    //
    protected $table='publicvacations';

    protected $fillable=['id','Date'];
    public $timestamps = false;
}
