<?php

namespace App\Models;

use App\Models\PlaceChoices;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChoicesContent extends Model
{
    use HasFactory;

    protected $fillable = [
        'place_choice_id',
        'image',
    ];

    public function placeChoice()
    {
        return $this->belongsTo(PlaceChoices::class);
    }
}
