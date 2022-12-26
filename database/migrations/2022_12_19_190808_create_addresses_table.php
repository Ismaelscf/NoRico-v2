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
            $table->foreignId('user_id')->constrained('users', 'id')->nullable();
            $table->foreignId('store_id')->constrained('stores', 'id')->nullable();
            $table->enum('type', ['comercial', 'pessoal']);
            $table->string('state', 30)->default('MA');
            $table->string('city', 100)->default('Nova Olinda');
            $table->string('district', 100)->default('Centro');
            $table->string('street');
            $table->string('zip_code')->nullable()->default(null);
            $table->string('number', 5)->nullable();
            $table->string('complement')->nullable();
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
