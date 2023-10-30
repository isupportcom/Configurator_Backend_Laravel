<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CardsPlace extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "product_card_id"
    ];

    public function choices()
    {
        return $this->hasMany(PlaceChoices::class);
    }
}
