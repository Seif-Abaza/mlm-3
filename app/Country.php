<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $table = 'countries';
    public  $primaryKey = 'id';
    public $timestamps = false;

    //Belongs To
    public function continent(){
        return $this->belongsTo('App\Continent');
    }

    public function region(){
        return $this->belongsTo('App\Region');
    }

    //Has Many
    public function members(){
        return $this->hasMany('App\Member');
    }
}
