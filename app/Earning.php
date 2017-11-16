<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Earning extends Model
{
    protected $table = 'earnings';
    public  $primaryKey = 'id';
    public $timestamps = true;

    //Belongs To
    public function earningType(){
        return $this->belongsTo('App\EarningType');
    }

    public function user(){
        return $this->belongsTo('App\User', ['created_by', 'updated_by']);
    }

    public function ofType(){
        return $this->belongsTo('App\EarningType', 'type');
    }
}
