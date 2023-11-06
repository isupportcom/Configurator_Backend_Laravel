<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rulescnd extends Model
{
    use HasFactory;

    protected $fillable = [
        'idr',
        're',
        'sosourcer',
        'idc',
    ];

    public function rules()
    {
        return $this->belongsTo(Rules::class, 'idr', 'id');
    }
}
