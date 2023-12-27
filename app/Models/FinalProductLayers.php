<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PO;

class FinalProductLayers extends Model
{
    use HasFactory;

    protected $fillable = [
        'final_product_id',
        'layers'
    ];


    public function final_product()
    {
        return $this->belongsTo(FinalProduct::class);
    }

    public function imageOuput()
    {
        return $this->hasOne(ImagesOutput::class);
    }
}
