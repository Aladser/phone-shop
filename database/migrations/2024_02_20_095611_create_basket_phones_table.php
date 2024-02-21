<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('basket_phones', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->bigInteger('phone_id')->unsigned();
            $table->foreign('phone_id')->references('id')->on('phones')->cascadeOnDelete();
            $table->integer('count')->unsigned()->default(1);
            $table->index(['user_id', 'phone_id'])->unique();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('basket_phones');
    }
};
