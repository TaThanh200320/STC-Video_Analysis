<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class Camera extends Model
{
    use HasFactory;
    protected $table = 'cameras';

    protected $fillable = ['ten', 'duongdan', 'diachiip', 'cong', 'tendangnhap', 'matkhau', 'trangthai', 'taoboi', 'capnhatboi', 'vitriid', 'nhomid'];

    protected $hidden = [
        'matkhau',
    ];

    public function position()
    {
        return $this->belongsTo(Position::class, 'vitriid');
    }

    public function group()
    {
        return $this->belongsTo(Group::class, 'nhomid');
    }

    public function cameraTasks()
    {
        return $this->belongsToMany(Task::class, 'tacvucuacamera', 'cameraid', 'tacvuid')->withPivot('cauhinh');
    }

    public function scopePublished($query)
    {
        $query->where('created_at', '<=', Carbon::now());
    }

    public function getRtspUrl()
    {
        return sprintf(
            'rtsp://%s:%s@%s:%d%s',
            $this->tendangnhap,
            Crypt::decryptString($this->matkhau),
            $this->diachiip,
            $this->cong,
            $this->duongdan
        );
    }
}
