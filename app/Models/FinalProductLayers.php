<?php

namespace App\Models;

use App\Events\LayerCreated;
use App\Events\LayerUpdated;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PO;

class FinalProductLayers extends Model
{
    use HasFactory;

    protected $fillable = [
        'final_product_id',
        'layers',
        'layer_id'
    ];

    public function layers()
    {
        return $this->hasMany(Layer::class, 'final_product_layer_id');
    }

    public function layerImages()
    {
        return $this->hasMany(LayerImages::class);
    }

    public function final_product()
    {
        return $this->belongsTo(FinalProduct::class);
    }

    public function imageOuput()
    {
        return $this->hasMany(ImagesOutput::class);
    }

    public static function boot()
    {
        parent::boot();

        static::created(function ($finalProductLayer) {
            event(new LayerCreated($finalProductLayer));
        });


        static::updated(function ($finalProductLayer) {
            event(new LayerUpdated($finalProductLayer));
        });
    }
}
