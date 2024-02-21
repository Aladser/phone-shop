<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    /** телефоны заказа */
    public function order_phones()
    {
        return $this->hasMany(OrderPhone::class, 'order_id', 'id');
    }
}
