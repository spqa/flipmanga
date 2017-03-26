<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;

class Manga extends Model
{
    use SoftDeletes;
    protected $dates=['deleted_at','created_at','updated_at','released_at'];
    public $guarded=['deleted_at','created_at','updated_at'];
    public function chapters(){
        return $this->hasMany(Chapter::class);
    }

    public function genres(){
        return $this->belongsToMany(Genre::class);
    }
    public function getCachedGenres(){
        return Cache::tags('genre')->rememberForever($this->getCacheKey(),function (){
            return $this->genres()->get();
        });
    }

    public function getCachedAuthors(){
        return Cache::tags('author')->rememberForever($this->getCacheKey(),function (){
            return $this->authors()->get();
        });
    }

    public function getCacheKey($tag=''){
        return 'manga:'.$this->id.$tag;
    }

    public function getFavorite(){
        if (!Redis::exists($manga_fav_cache_key=$this->getCacheKey('favorite'))){
//            dd($manga);
            $this->users()->get()->each(function ($user){
                Redis::sadd($this->getCacheKey('favorite'),$user->id);
            });
        }
        return Redis::scard($this->getCacheKey('favorite'));
    }
    public function getCacheLatestChap(){
        return Cache::tags('latest.chap')->rememberForever($this->getCacheKey(),function (){
            if ($this->chapters()->count()>0){
                return Chapter::where('manga_id',$this->id)->orderBy('chapter_number','desc')->first();
            }
            return new Chapter();
        });
    }
    public function authors(){
        return $this->belongsToMany(Author::class);
    }

    public function users(){
        return $this->belongsToMany(User::class);
    }

    public function categories(){
        return $this->belongsToMany(Category::class);
    }
}
