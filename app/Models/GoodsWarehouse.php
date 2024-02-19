<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GoodsWarehouse extends Model
{
    use HasFactory;
    protected $table = 'goods_warehouses';

    protected $fillable = [
        'wg_code',
        'gw_reason',
        'gw_total',
        'gw_user_id ',
        'wg_supplier_id ',
        'created_at',
    ];

    protected $goodwarehouse = [
        'created_at'=> 'datetime:d/m/Y',
    ];

    public function getCreatedAtAttribute($value)
    {
        return date('d/m/Y', strtotime($value)); // Định dạng theo 'Ngày/Tháng/Năm'
    }

    public function supplier()
    {
        return $this->belongsTo(Suppliers::class,'wg_supplier_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'gw_user_id', 'id');
    }
}
