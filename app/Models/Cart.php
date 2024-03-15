<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Cart extends Model
{
    use HasFactory;
    protected $table = 'carts';
    protected $fillable = [
        'product_id',
        'product_quantity',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

  
}
