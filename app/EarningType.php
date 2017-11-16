<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EarningType extends Model
{
    protected $table = 'earningType';
    public  $primaryKey = 'id';
    public $timestamps = false;

    //Belongs To
    public function user(){
        return $this->belongsTo('App\User', ['created_by', 'updated_by']);
    }
}
