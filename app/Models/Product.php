<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $fillable = [
        'product_name',
        'product_quantity',
        'product_category',
        'product_price',
        'product_image',

    ];


    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'order');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }



}
