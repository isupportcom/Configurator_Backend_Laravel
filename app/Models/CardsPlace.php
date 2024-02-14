<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CardsPlace extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "product_card_id",
        "layer_id"
    ];

    public function choices()
    {
        return $this->hasMany(PlaceChoices::class,'card_place_id');
    }
    public function card()
    {
        return $this->belongsTo(ProductsCard::class);
    }
    public function layers()
    {
        return $this->hasMany(LayerImages::class,'card_place_id');
    }

}
