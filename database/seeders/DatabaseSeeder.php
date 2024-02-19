<?php

namespace Database\Seeders;

use App\Models\Phone;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create(['name' => 'admin', 'email' => 'aladser@mail.ru', 'password' => '$2y$12$ZLkZC5lzI4teuoTNTxQnyuev1eQqOsGb5tQ241KN/aQYGHYz.Znle']);
        Phone::create(['name' => 'phone 1', 'price' => 1000]);
        Phone::create(['name' => 'phone 2', 'price' => 2000]);
        Phone::create(['name' => 'phone 3', 'price' => 3000]);
        Phone::create(['name' => 'phone 4', 'price' => 4000]);
        Phone::create(['name' => 'phone 5', 'price' => 5000]);
    }
}
