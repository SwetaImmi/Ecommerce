<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;
    protected $table ='banner';
    protected $fillable = [
        'main_banner_content',
        'main_banner_image',
        'first_banner_content',
        'first_banner_image',
        'second_banner_content',
        'second_banner_image',
        'third_banner_content',
        'third_banner_image',
        'last_banner_content',
        'last_banner_image',
        'status',
    ];
}
