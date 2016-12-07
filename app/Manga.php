<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Manga extends Model
{
    use SoftDeletes;
    public $guarded=['deleted_at','created_at','updated_at'];
    public function chapters(){
        return $this->hasMany(Chapter::class);
    }
}
