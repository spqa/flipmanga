<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $guarded=[];

    public function tags(){
        return $this->morphToMany(Tag::class,'taggable');
    }
}
