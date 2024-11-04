<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Layout extends Model
{
    use HasFactory;

    protected $fillable = ['userId', 'layout', 'preferences'];

    protected $casts = [
        'layout' => 'array',
        'preferences' => 'array',
    ];
}