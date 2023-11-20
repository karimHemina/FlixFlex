<?php

namespace App\Models;

use App\Enums\ShowType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Show extends Model
{
    use HasFactory;

    protected $casts = [
        'type'  =>  ShowType::class,
    ];

    public function scopeFilter($query)
    {
        if (request('title')) {
            $query->where('title', 'like', '%' . request('title') . '%');
        }

        return $query;
    }
}
