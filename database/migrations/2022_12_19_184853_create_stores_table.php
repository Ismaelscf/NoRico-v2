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
        Schema::create('stores', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('cnpj', 14)->unique()->nullable(false);
            $table->string('email')->unique()->nullable(false);
            $table->string('phone', 12)->nullable(false);
            $table->string('logo')->nullable(true);
            $table->float('full_discount')->nullable(true);
            $table->float('percentage_discount')->nullable(true);
            $table->boolean('active');
            $table->boolean('discount');
            $table->boolean('sort');
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
        Schema::dropIfExists('stores');
    }
};
