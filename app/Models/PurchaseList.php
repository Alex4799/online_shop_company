<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseList extends Model
{
    use HasFactory;
    protected $fillable =[
        'user_id',
        'product_id',
        'qty',
        'total',
        'purchases_id',
    ];
}
