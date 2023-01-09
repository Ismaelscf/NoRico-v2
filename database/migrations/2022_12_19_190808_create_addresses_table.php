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
            
            // $table->integer('user_id')->nullable()->default(null);
            // $table->integer('store_id')->nullable()->default(null);

            // $table->unsignedBigInteger('user_id')->nullable()->default(0);
            // $table->foreign('user_id')->references('id')->on('users');
            // $table->unsignedBigInteger('store_id')->nullable()->default(0);
            // $table->foreign('store_id')->references('id')->on('stores');
            
            $table->foreignId('user_id')->nullable()->constrained('users', 'id')->default(0);
            $table->foreignId('store_id')->nullable()->constrained('stores', 'id')->default(0);
            
            $table->enum('type', ['comercial', 'pessoal']);
            $table->string('state', 30)->nullable();;
            $table->string('city', 100)->nullable();;
            $table->string('district', 255)->nullable();;
            $table->string('street')->nullable();;
            $table->string('zip_code')->nullable();
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
