<?php


namespace App;


use Illuminate\Database\Eloquent\Model;

class Showsuggestion extends Model
{

    protected $table='showsuggestions';
    protected $fillable =['id','UserName','Creation'];
    public $timestamps=false;

}
