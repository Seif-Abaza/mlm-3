<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    protected $table = 'regions';
    public  $primaryKey = 'id';
    public $timestamps = false;

    //Has Many
    public function countries(){
        return $this->hasMany('App\Country');
    }
}
