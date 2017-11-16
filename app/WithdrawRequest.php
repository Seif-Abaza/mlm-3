<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WithdrawRequest extends Model
{
    protected $table = 'withdrawRequests';
    public  $primaryKey = 'id';
    public $timestamps = true;

    //Belongs To
    public function member(){
        return $this->belongsTo('App\Member');
    }

    public function user(){
        return $this->belongsTo('App\User', ['created_by', 'updated_by']);
    }
}
