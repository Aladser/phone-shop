<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderPhone extends Model
{
    use HasFactory;
    public $timestamps = false;

    // заказ
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }

    // телефон
    public function phone()
    {
        return $this->belongsTo(Phone::class, 'phone_id', 'id');
    }
}
