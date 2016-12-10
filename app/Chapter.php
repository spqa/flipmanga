<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    public $guarded=[];
    public function manga(){
        return $this->belongsTo(Manga::class);
    }
}
