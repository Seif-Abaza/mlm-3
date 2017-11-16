<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Share extends Model
{
    protected $table = 'shares';
    public  $primaryKey = 'id';
    public $timestamps = true;

    //Belongs To
    public function member(){
        return $this->belongsTo('App\Member', 'owner');
    }
    public function user(){
        return $this->belongsTo('App\User', ['created_by', 'updated_by']);
    }
}
