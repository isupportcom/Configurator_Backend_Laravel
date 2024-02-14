<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LayerEntity extends Model
{
    use HasFactory;

    protected $fillable = [
        'cat_cons',
        'image',
        'unique_layer_id'
    ];

    protected $casts = [
        'cat_cons' => 'array',
    ];

   // In Layer model
public function finalProductLayer()
{
    return $this->belongsTo(FinalProductLayers::class, 'final_product_layer_id');
}


    public function layers()
    {
        return $this->belongsTo(Layer::class, 'final_product_layer_id');
    }
    
}
