<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->decimal("all_price");
            $table->foreignId("user_id")->constrained()->cascadeOnUpdate();
            $table->string("status")->default("pinding");
            $table->string("first_name");
            $table->string("last_name");
            $table->string("phone");
            $table->string("email");
            $table->string("address_1");
            $table->string("address_2")->nullable();
            $table->string("country");
            $table->string("city");
            $table->string("pin_code");
            $table->string("method");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
