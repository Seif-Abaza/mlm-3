<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payout extends Model
{
    protected $table = 'payouts';
    public  $primaryKey = 'id';
    public $timestamps = true;

    //Belongs To
    public function share(){
        return $this->belongsTo('App\Share', 'share_id');
    }

    public function user(){
        return $this->belongsTo('App\User', ['created_by', 'updated_by']);
    }
}
