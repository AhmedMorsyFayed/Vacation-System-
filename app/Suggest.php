<?php


namespace App;


use Illuminate\Database\Eloquent\Model;

class Suggest extends Model
{
    protected $table='suggestions';
    protected $fillable=['id','Type','reqtype','name','ip','description','Creation'];
    public $timestamps = false;
}
