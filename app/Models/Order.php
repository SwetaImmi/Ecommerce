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
        'order_name',
        'order_address',
        'order_city',
        'order_state',
        'order_zip',
        'order_mobile',
        'order_nearby',
        'paymentmode',
        'order_status',
        'card_name',
        'card_number',
        'card_cvv',
        'card_month',
        'card_year',
    ];
}
