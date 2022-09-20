<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Holiday extends Model
{
    public $table = 'holidays';
    protected $fillable = [
'	UpdateHRDate','AprovaleHRDate','HR','HRname','	AprovaleDate','creation','status','manger','Department','name'
        ,'HloiDays','idHoliday','VAcationstype','start','end'
    ];
    public $timestamps = false;


    public function user()
    {
        return $this->belongsTo(User::class,'name', 'name');
    }

}
