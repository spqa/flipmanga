<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    protected $guarded=[];
    public function mangas(){
        return $this->belongsToMany(Manga::class);
    }
}
