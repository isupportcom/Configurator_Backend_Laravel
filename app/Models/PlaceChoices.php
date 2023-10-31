<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlaceChoices extends Model
{
    use HasFactory;

    protected $fillable = [
        'cards_place_id',
        'name',
    ];


    public function content()
    {
        return $this->hasMany(ChoicesContent::class);
    }
}
