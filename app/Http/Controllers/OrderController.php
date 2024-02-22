<?php

namespace App\Http\Controllers;

use App\Models\BasketPhone;
use App\Models\Order;
use App\Models\OrderPhone;
use App\Models\Phone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// Заказы
class OrderController extends Controller
{
    public function index()
    {
        $user_id = Auth::user()->id;
        // заказы из БД
        $orderData = Order::where('user_id', $user_id)->get();
        // массив заказов
        $orderArr = [];
        // итоговая стоимость всех заказов
        $allOrderPrice = 0;

        foreach ($orderData as $order) {
            // телефоны заказа строкой
            $phoneArrStr = '';
            // общая стоимость заказов
            $orderArr[$order->id]['total_price'] = 0;
            // время создания
            $orderArr[$order->id]['created_at'] = $order->created_at->toDateTimeString();

            foreach ($order->order_phones as $order_phone) {
                $phoneArrStr .= "{$order_phone->phone->name}, ";
                $orderArr[$order->id]['total_price'] += $order_phone->phone->price * $order_phone->count;
            }
            $allOrderPrice += $orderArr[$order->id]['total_price'];
            $orderArr[$order->id]['phones'] = mb_substr($phoneArrStr, 0, mb_strlen($phoneArrStr) - 2);
        }

        return view(
            'orders',
            [
                'all_total_price' => $allOrderPrice,
                'orders' => $orderArr,
                'is_auth' => !empty(Auth::user()),
            ]
        );
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

        return view('store_order', ['order_id' => $order->id, 'order_created_at' => $order->created_at->toDateTimeString()]);
    }

    public function destroy(int $id)
    {
        var_dump($id);
    }
}
