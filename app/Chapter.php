<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    public $guarded=[];
    protected $touches=['manga'];
    public function manga(){
        return $this->belongsTo(Manga::class);
    }

    public function typeImg(){
        return $this->belongsTo(TypeImg::class,'type_img_id');
    }
}
