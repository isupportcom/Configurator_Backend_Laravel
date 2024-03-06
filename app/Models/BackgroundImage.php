<?php

namespace App\Models;

use App\Events\BackgrounImageUpdated;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BackgroundImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'image'
    ];

    public static function boot(){
        parent::boot();
        static::updated(function($image){
            event(new BackgrounImageUpdated($image));
        });
    }
    

}

