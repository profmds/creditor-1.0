<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Oer extends Model
{
   protected $fillable = [
        'uri', 'title', 'author'
    ];
}
