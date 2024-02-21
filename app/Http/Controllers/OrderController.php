<?php

namespace App\Http\Controllers;

use App\Models\BasketPhone;
use App\Models\Order;
use App\Models\OrderPhone;
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
        $user_id = Auth::user()->id;

        // создание заказа
        $order = new Order();
        $order->user_id = $user_id;
        $order->save();
        if (!$order->save()) {
            echo 'серверная ошибка добавления пользователя';

            return;
        }

        // товары из корзины
        $basketPhones = BasketPhone::where('user_id', $user_id)->get();
        // добавление товаров заказа
        foreach ($basketPhones as $basketPhoneRow) {
            $orderPhone = new OrderPhone();
            $orderPhone->order_id = $order->id;
            $orderPhone->phone_id = $basketPhoneRow->phone_id;
            $orderPhone->count = $basketPhoneRow->count;
            $orderPhone->save();
            if (!$orderPhone->save()) {
                echo 'серверная ошибка добавления пользователя';

                return;
            }
        }
        // очистка корзины
        BasketPhone::where('user_id', $user_id)->delete();

        return redirect()->route('main');
    }
}
