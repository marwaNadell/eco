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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("slug");
            $table->decimal("price");
            $table->decimal("sale");
            $table->decimal("tax");
            $table->decimal("qty");
            $table->string("image");
            $table->boolean("treandy");
            $table->boolean("featured")->nullable();
            $table->string("description");
            $table->foreignId("category_id")->constrained()->onUpdate("cascade");
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
        Schema::dropIfExists('products');
    }
};
