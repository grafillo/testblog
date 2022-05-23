<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;


    public function getAvatar(){

        return $this->hasOne('App\Models\User','id','autor_id');
    }

}
