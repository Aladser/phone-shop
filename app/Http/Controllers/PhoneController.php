<?php

namespace App\Http\Controllers;

use App\Models\Phone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PhoneController extends Controller
{
    public function index()
    {
        return view(
            'welcome',
            [
                'phones' => Phone::all(),
                'is_auth' => Auth::user(),
            ]
        );
    }

    public function create()
    {
    }

    public function store(Request $request)
    {
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
