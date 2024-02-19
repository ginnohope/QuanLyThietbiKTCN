<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $products = [
        'created_at'=> 'datetime:d/m/Y',
    ];

    public function getCreatedAtAttribute($value)
    {
        return date('d/m/Y', strtotime($value)); // Định dạng theo 'Ngày/Tháng/Năm'
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'p_user_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'p_category_id', 'id');
    }

    public function supplier()
    {
        return $this->belongsTo(Suppliers::class,'p_supplier_id', 'id');
    }
}
