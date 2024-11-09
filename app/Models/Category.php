<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Cache;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function news()
    {
        return $this->hasMany(News::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::saved(function($news){
            Cache::tags(['news'])->flush();
        });

        static::deleted(function($news){
            Cache::tags(['news'])->flush();
        });
    }
}
