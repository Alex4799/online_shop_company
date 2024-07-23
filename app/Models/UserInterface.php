<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserInterface extends Model
{
    use HasFactory;
    protected $fillable = [
        'company_name',
        'company_email',
        'company_phone',
        'company_address',
        'description',
        'company_logo',
        'cover_image',
        'about_us_description',
        'about_us_image',
        'footer_description',
        'font_color',
        'bg_color',
    ];

    protected $casts = [
        'about_us_image'=>'array'
    ];

}
