<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $table = 'tacvu';

    protected $fillable = ['ten', 'mota', 'cauhinh'];

    protected $casts = [
        'cauhinh' => 'array', // Ensure cauhinh is always json
    ];

    public function cameraTasks()
    {
        return $this->belongsToMany(Camera::class, 'tacvucuacamera', 'cameraid', 'tacvuid')->withPivot('cauhinh');
    }

    public function getPivotCauhinhAsArray()
    {
        if ($this->pivot && isset($this->pivot->cauhinh)) {
            return json_decode($this->pivot->cauhinh, true) ?: [];
        }
        return [];
    }
}
