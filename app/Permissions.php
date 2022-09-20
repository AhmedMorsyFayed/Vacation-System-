<?php


namespace App;


use Illuminate\Database\Eloquent\Model;

class Permissions extends Model
{
    public $table = 'permmision';
    protected $fillable = [
        '	UpdateHRDate','AprovaleHRDate','HR','HRname','	AprovaleDate','creation','status','manger','Department','name'
        ,'idpermision','permisionshours','day','start','end'
    ];

    public $timestamps = false;


}
