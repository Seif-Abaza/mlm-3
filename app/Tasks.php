<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tasks extends Model
{
    protected $table = 'tasks';
    public  $primaryKey = 'id';
    public $timestamps = false;
}
