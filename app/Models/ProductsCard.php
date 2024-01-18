<?php

namespace App\Models;

use App\Models\Rules;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductsCard extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "icon",
        "tab_order",
        "final_product_id"
    ];

    public function places()
    {
        return $this->hasMany(CardsPlace::class,'product_card_id');
    }
    
    public function finalProduct()
    {
        return $this->belongsTo(FinalProduct::class);
    }
}
