<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $table = 'members';
    public  $primaryKey = 'id';
    public $timestamps = true;

    //Belongs To
    public function country(){
        return $this->belongsTo('App\Country');
    }
    public function user(){
        return $this->belongsTo('App\User', ['created_by', 'updated_by']);
    }

    public function ofSponsor(){
        return $this->belongsTo('App\Member', 'sponsor');
    }
    public function ofUpline(){
        return $this->belongsTo('App\Member', 'upline');
    }

    //static functions
    public static function sponsees($id){
        $s = Member::where('sponsor','=', $id)->where('id','!=',$id)->get();
        return $s;
    }
    public static function downlines($id){
        $u = Member::where('upline','=',$id)->where('id','!=',$id)->get();
        return $u;
    }

}
