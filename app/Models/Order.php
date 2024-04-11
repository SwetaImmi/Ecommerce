<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'order';
    protected $fillable = [
        'user_id',
        'address_id',
        'order_email',
        'product_quantity',
        'product_price',
        'paymentmode',
        'card_name',
        'card_number',
        'card_cvv',
        'card_month',
        'card_year',
    ];
}
