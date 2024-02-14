<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LayerImages extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'layer_id',
        'unique_layer_id'
    ];

    
    public function UniqueLayers()
    {
        return $this->belongsTo(Layer::class, 'unique_layer_id');
    }


    public function layers()
    {
        return $this->belongsTo(FinalProductLayers::class);
    }

    public function cardPlace()
    {
        return $this->belongsTo(CardsPlace::class);
    }


}
