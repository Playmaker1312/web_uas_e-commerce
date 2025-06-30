<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ZakiOrder extends Model
{
    use HasFactory;
    protected $table = 'zaki_orders';
    protected $fillable = [
        'user_id', 'total', 'shipping_address', 'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(ZakiOrderItem::class, 'order_id');
    }
} 