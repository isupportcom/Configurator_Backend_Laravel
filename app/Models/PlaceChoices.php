<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlaceChoices extends Model
{
    use HasFactory;

    protected $fillable = [
        'card_place_id',
        'image',
        'name',
    ];


    public function cardPlace()
    {
        return $this->belongsTo(CardsPlace::class);
    }


    
    


}