<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    use HasFactory;
    public $timestamps = false;

    // телефоны заказа
    public function order_phones()
    {
        return $this->hasMany(OrderPhone::class, 'phone_id', 'id');
    }
}
