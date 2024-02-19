<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomDetail extends Model
{
    use HasFactory;

    protected $table = 'roomdetail';

    protected $fillable = [
        'rd_code',
        'rd_product_id',
        'rd_quantity',
        'rd_total',
        'rd_Percentage',
        'rd_state',
        'created_at',
        'rd_device_id',
        'rd_notes'
    ];

    protected $roomdetail = [
        'created_at'=> 'datetime:d/m/Y',
    ];

    public function getCreatedAtAttribute($value)
    {
        return date('d/m/Y', strtotime($value)); // Định dạng theo 'Ngày/Tháng/Năm'
    }

    public function product()
    {
        return $this->belongsTo(Product::class,'rd_product_id', 'id');
    }

    public function device()
    {
        return $this->belongsTo(MaySD::class,'rd_device_id', 'id');
    }
}
