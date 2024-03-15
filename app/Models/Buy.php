<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buy extends Model
{
    use HasFactory;

    protected $table = 'buy_now';
    protected $fillable = [
        'product_id',
        'product_quantity',
    ];

    public function produts()
    {
        return $this->belongsTo(Product::class);
    }
}
