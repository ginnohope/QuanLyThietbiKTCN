<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaySD extends Model
{
    use HasFactory;

    protected $table = 'maysd';

    protected $fillable = [
        'm_code',
        'm_name',
        'm_room_id',
        'm_cate_id',
        'm_usedate',
        'm_notes',
        'm_active',
    ];

    protected $maysd = [
        'created_at'=> 'datetime:d/m/Y',
    ];

    public function getCreatedAtAttribute($value)
    {
        return date('d/m/Y', strtotime($value)); // Định dạng theo 'Ngày/Tháng/Năm'
    }

    public function room()
    {
        return $this->belongsTo(Room::class, 'm_room_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'm_cate_id', 'id');
    }
}
