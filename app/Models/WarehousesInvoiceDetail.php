<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WarehousesInvoiceDetail extends Model
{
    use HasFactory;

    protected $table = 'warehouses_invoice_details';
    protected $fillable = ['wid_quantity', 'wid_total', 'wid_goodwarehouse_id', 'wid_product_id', 'created_at'];

    protected $warehousesinvoicedetail = [
        'created_at'=> 'datetime:d/m/Y',
    ];

    public function getCreatedAtAttribute($value)
    {
        return date('d/m/Y', strtotime($value)); // Định dạng theo 'Ngày/Tháng/Năm'
    }

    public function goodWarehouse()
    {
        return $this->belongsTo(GoodsWarehouse::class,'wid_goodWarehouse_id', 'id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class,'wid_product_id', 'id');
    }
}
