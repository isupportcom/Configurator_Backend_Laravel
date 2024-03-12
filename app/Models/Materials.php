<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materials extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'min',
        'max',
        'card_place_id',
    ];

    public function cardPlace()
    {
        return $this->belongsTo(CardsPlace::class);
    }
}
