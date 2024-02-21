<?php

namespace App\Http\Controllers;

use App\Models\BasketPhone;
use App\Models\Phone;
use Illuminate\Support\Facades\Auth;

// Телефоны
class PhoneController extends Controller
{
    public function index()
    {
        $authUser = Auth::user();
        if ($authUser) {
            $basketPhoneCount = BasketPhone::where('user_id', $authUser->id)->sum('count');
            $is_auth = true;
        } else {
            $basketPhoneCount = 0;
            $is_auth = false;
        }

        return view(
            'welcome',
            [
                'phones' => Phone::all(),
                'is_auth' => $is_auth,
                'basket_phone_count' => $basketPhoneCount,
            ]
        );
    }
}
