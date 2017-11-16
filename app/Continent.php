<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Continent extends Model
{
    //Table Name
    protected $table = 'continents';
    //Primary Key
    public $primaryKey = 'id';
    //Timestamps
    public $timestamps = false;

    //hasMany
    public function countries(){
        return $this->hasMany('App\Country');
    }
}
