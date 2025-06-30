<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ZakiOrderItem extends Model
{
    use HasFactory;
    protected $table = 'zaki_order_items';
    protected $fillable = [
        'order_id', 'product_id', 'quantity', 'price'
    ];

    public function order()
    {
        return $this->belongsTo(ZakiOrder::class, 'order_id');
    }

    public function product()
    {
        return $this->belongsTo(ZakiProduct::class, 'product_id');
    }
} 