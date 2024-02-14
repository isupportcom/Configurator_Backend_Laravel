<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Layer extends Model
{
    use HasFactory;

    protected $fillable = [
        'unique_layer_id',
        'final_product_layer_id'
    ];

   // In Layer model
public function finalProductLayer()
{
    return $this->belongsTo(FinalProductLayers::class, 'final_product_layer_id');
}


    public function layers()
    {
        return $this->hasMany(Layer::class, 'final_product_layer_id');
    }
    
}
