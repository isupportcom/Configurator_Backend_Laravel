<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductsCard extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "icon",
        "final_product_id"
    ];

    public function places()
    {
        return $this->hasMany(CardsPlace::class);
    }
}
