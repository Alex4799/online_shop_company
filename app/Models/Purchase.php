<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;
    protected $fillable =[
        'user_id',
        'supplier_id',
        'total_price',
        'qty',
        'product_id',
        'payment_id',
        'payment_slip',
        'status',
    ];
}
