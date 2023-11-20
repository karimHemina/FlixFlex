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
}
