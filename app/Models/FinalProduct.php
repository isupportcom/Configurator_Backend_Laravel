<?php

namespace App\Models;

use App\Models\Rules;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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


}
