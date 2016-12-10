<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Manga extends Model
{
    use SoftDeletes;
    protected $dates=['deleted_at','created_at','updated_at','released_at'];
    public $guarded=['deleted_at','created_at','updated_at'];
    public function chapters(){
        return $this->hasMany(Chapter::class);
    }
}
