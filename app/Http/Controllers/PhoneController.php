<?php

namespace App\Http\Controllers;

use App\Models\BasketPhone;
use App\Models\Phone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PhoneController extends Controller
{
    public function index()
    {
        $authUserId = Auth::user()->id;

        return view(
            'welcome',
            [
                'phones' => Phone::all(),
                'is_auth' => Auth::user(),
                'basket_phone_count' => BasketPhone::where('user_id', $authUserId)->count(),
            ]
        );
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $phone_name = $data['name'];

        $phone = Phone::where('name', $phone_name);
        if ($phone->exists()) {
            // ---добавление телефона в корзину---
            $phone_id = $phone->first()->id;
            $user_id = Auth::user()->id;
            // поиск этого телефона у пользователя в корзине
            $basketPhone = BasketPhone::where('user_id', $user_id)->where('phone_id', $phone_id);
            // добавление в корзину
            if ($basketPhone->exists()) {
                $basketPhone = $basketPhone->first();
                ++$basketPhone->count;
            } else {
                $basketPhone = new BasketPhone();
                $basketPhone->phone_id = $phone_id;
                $basketPhone->user_id = $user_id;
                $basketPhone->count = $data['count'];
            }
            $isAdded = $basketPhone->save();
            if ($isAdded) {
                echo json_encode(['result' => 1, 'count' => $basketPhone->count]);
            } else {
                echo json_encode(['result' => 0, 'description' => 'серверная ошибка добавления пользователя']);
            }
        } else {
            echo json_encode(['result' => 0, 'description' => "товар $phone_name не существует"]);
        }
    }

    public function show(string $id)
    {
    }

    public function edit(string $id)
    {
    }

    public function update(Request $request, string $id)
    {
    }

    public function destroy(string $id)
    {
    }
}
