<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        Schema::create('order_phones', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('order_id')->unsigned();
            $table->foreign('order_id')->references('id')->on('orders')->cascadeOnDelete();
            $table->bigInteger('phone_id')->unsigned();
            $table->foreign('phone_id')->references('id')->on('phones')->cascadeOnDelete();
            $table->integer('count')->unsigned()->default(1);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order_phones');
    }
};
