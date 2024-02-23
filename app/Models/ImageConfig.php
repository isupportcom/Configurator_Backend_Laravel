<?php

namespace App\Models;

use App\Events\FinalProductCreated;
use App\Models\Rules;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\FinalProductLayers;
use App\Models\ProductsCard;
use App\Models\PlaceChoices;

class ImageConfig extends Model
{
    use HasFactory;

    // anna apo envia

    protected $fillable = [
        'layer_id',
        'width',
        'height',
        'opacity',
        'posX',
        'posY',
        'posZ',
    ];

    public function Layers()
    {
        return $this->belongsTo(Layer::class, 'id');
    }

   
   

   
}
