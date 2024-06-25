<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

//extra
use Illuminate\Database\Eloquent\Casts\AsArrayObject;

class Package extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    protected $casts = [ //extra
        'app_features' => AsArrayObject::class,
    ];
}
