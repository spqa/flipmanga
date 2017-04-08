<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Meme extends Model
{
    public $guarded=[];
    public function user(){
        return $this->belongsTo(User::class);
    }
}
