<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplierProduct extends Model
{
    use HasFactory;
    protected $fillable =[
        'name',
        'image',
        'active',
        'count',
        'description',
        'category_id',
        'brand_id',
        'price',
        'view',
        'user_id',
        'instock',
    ];
    protected $casts = [
        'image' => 'array',
    ];
}
