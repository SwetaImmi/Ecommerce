<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;
    protected $table = 'product_galleries';
    protected $fillable = [
        'products_id',
        'product_gallery_image',
        'product_color_image',
        'email',
    ];


    public function products()
    {
        return $this->belongsTo(Product::class);
    }
   
}
