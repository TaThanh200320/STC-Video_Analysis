<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Camera extends Model
{
    use HasFactory;
    protected $table = 'cameras';

    protected $fillable = ['ten', 'duongdan', 'diachiip', 'cong', 'tendangnhap', 'matkhau', 'trangthai', 'taoboi', 'capnhatboi', 'vitriid', 'nhomid'];

    protected $hidden = [
        'matkhau',
    ];

    protected function casts(): array
    {
        return [
            'matkhau' => 'hashed',
        ];
    }

    public function position()
    {
        return $this->belongsTo(Position::class, 'vitriid');
    }

    public function group()
    {
        return $this->belongsTo(Group::class, 'nhomid');
    }

    public function aiGroups()
    {
        return $this->belongsToMany(Group::class, 'nhomchucnang');
    }
}
