<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Workshop extends Model
{
    use HasFactory;

    protected $table = 'phanxuong';

    protected $fillable = ['ten', 'ma', 'mota', 'khuvucid'];

    public function area()
    {
        return $this->belongsTo(Area::class, 'khuvucid');
    }

    public function positions()
    {
        return $this->hasMany(Position::class, 'phanxuongid');
    }
}
