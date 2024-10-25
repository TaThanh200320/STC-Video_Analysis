<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $table = 'nhom';

    protected $fillable = ['ten', 'mota', 'loainhom'];

    public function cameras()
    {
        if ($this->type === 'khuvuc') {
            return $this->hasMany(Camera::class);
        }

        return null;
    }

    public function aiCameras()
    {
        if ($this->type === 'chucnang') {
            return $this->belongsToMany(Camera::class, 'nhomchucnang');
        }

        return null;
    }
}
