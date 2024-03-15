<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = 'product_category';
    protected $fillable = [
        'category',
    ];

    public function product_category()
    {
        return $this->hasOne(Product::class);
    }
}
