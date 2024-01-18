<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImagesOutput extends Model
{
    use HasFactory;

    protected $fillable = [
        'final_product_layers_id',
        'image'
    ];

    public function layers()
    {
        return $this->belongsTo(FinalProductLayers::class);
    }

}
