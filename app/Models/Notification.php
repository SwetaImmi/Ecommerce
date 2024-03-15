<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $table = 'notifications';
    protected $fillable = [
        'user_id ',
        'product_id ',
        'notifiable_id',
        'type',
        'read',
        'read_at'
    ];
}
