<?php

namespace App\Models;

use App\Events\FinalProductCreated;
use App\Models\Rules;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\FinalProductLayers;

class FinalProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'image'
    ];

    public function card()
    {
        return $this->hasMany(ProductsCard::class);
    }

    public function layers()
    {
        return $this->hasMany(FinalProductLayers::class);
    }

    public static function boot()
    {
        parent::boot();

        static::created(function ($finalProduct) {
            event(new FinalProductCreated($finalProduct));
        });
    }
}
