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
            $table->foreignId('user_quotas_id')->constrained('user_quotas', 'id');
            $table->boolean('active')->default(true);
            $table->enum('status', ['pago', 'aberto', 'atraso'])->default('aberto');
            $table->float('price');
            $table->date('due_date');
            $table->date('payday')->nullable();
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
