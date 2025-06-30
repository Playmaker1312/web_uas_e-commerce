<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ZakiProduct extends Model
{
    use HasFactory;
    protected $table = 'zaki_products';
    protected $fillable = [
        'name', 'description', 'price', 'category_id', 'image', 'stock'
    ];

    public function category()
    {
        return $this->belongsTo(ZakiCategory::class, 'category_id');
    }

    public function orderItems()
    {
        return $this->hasMany(\App\Models\ZakiOrderItem::class, 'product_id');
    }
} 