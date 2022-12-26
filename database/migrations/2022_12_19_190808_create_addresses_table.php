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
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users', 'id')->nullable(true);
            $table->foreignId('store_id')->constrained('stores', 'id')->nullable(true);
            $table->enum('type', ['comercial', 'pessoal']);
            $table->string('state', 30)->nullable(false)->default('MA');
            $table->string('city', 100)->nullable(false)->default('Nova Olinda');
            $table->string('district', 100)->nullable(false)->default('Centro');
            $table->string('street')->nullable(false);
            $table->string('zip_code')->nullable(true);
            $table->string('number', 5)->nullable(true);
            $table->string('complement')->nullable(true);
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
        Schema::dropIfExists('addresses');
    }
};
