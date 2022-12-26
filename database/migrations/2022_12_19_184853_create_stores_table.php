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
            $table->string('cnpj', 14)->unique();
            $table->string('email')->unique();
            $table->string('phone', 12);
            $table->string('logo')->nullable();
            $table->float('full_discount')->nullable()->default(null);
            $table->float('percentage_discount')->nullable()->default(null);
            $table->boolean('active');
            $table->boolean('discount')->nullable()->default(false);
            $table->boolean('sort')->nullable()->default(false);
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
