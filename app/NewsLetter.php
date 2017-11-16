<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NewsLetter extends Model
{
    protected $table = 'news_letter';
    public  $primaryKey = 'id';
    public $timestamps = false;
}
