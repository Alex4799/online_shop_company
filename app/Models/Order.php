<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable=[
        'user_name',
        'user_email',
        'user_phone',
        'user_address',
        'invoice_id',
        'seller_id',
        'total_price',
        'payment_id',
        'payment_slip',
        'status',
    ];
}
