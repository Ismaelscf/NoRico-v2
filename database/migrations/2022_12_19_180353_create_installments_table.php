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
        Schema::create('installments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('quota_id')->constrained('quotas', 'id');
            $table->foreignId('user_id')->constrained('users', 'id');
            $table->foreignId('seller_id')->constrained('users', 'id');
            $table->float('price')->nullable(false);
            $table->date('due_date')->nullable(false);
            $table->date('payday')->nullable(true);
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
        Schema::dropIfExists('installments');
    }
};
