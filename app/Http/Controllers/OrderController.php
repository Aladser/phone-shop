<?php

namespace App\Http\Controllers;

use App\Models\BasketPhone;
use App\Models\Phone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        echo 'index';
    }

    public function create()
    {
        $basketPhoneRows = BasketPhone::where('user_id', Auth::user()->id);
        // массив товаров в корзине
        $basketPhoneArr = [];

        $totalPrice = 0;
        foreach ($basketPhoneRows->get() as $row) {
            $phone = Phone::find($row->phone_id);
            $basketPhoneArr[] = ['name' => $phone->name, 'price' => $phone->price, 'count' => $row->count];
            $totalPrice += $row->count * $phone->price;
        }

        return view(
            'dashboard',
            ['basket_phones' => $basketPhoneArr, 'total_price' => $totalPrice]
        );
    }

    public function store(Request $request)
    {
        echo 'Заказ оформлен!';
    }
}
