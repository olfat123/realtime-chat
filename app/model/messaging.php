<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;
use App\User;

class messaging extends Model
{
    protected $fillable=['message'];
    function user(){
        return $this->belongsTo(User::class);
    }
}
