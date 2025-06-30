<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ZakiCategory extends Model
{
    use HasFactory;
    protected $table = 'zaki_categories';
    protected $fillable = [
        'name'
    ];
} 