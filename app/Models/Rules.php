<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rules extends Model
{
    use HasFactory;

    protected $fillable = [
        'sosource',
        'idslc',
    ];

    public function rcnd()
    {
        return $this->hasMany(RulesCnd::class, 'idr', 'id');
    }
}
