<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DefaultSelections extends Model
{
    use HasFactory;


    protected $fillable = [
        'finalProductId',
        'mainSelected',
        'subSelected',
      
    ];

    protected $casts = [
        'subSelected' => 'array',
    ];



    public function finalProduct()
    {
        return $this->belongsTo(FinalProduct::class);
    }


}
