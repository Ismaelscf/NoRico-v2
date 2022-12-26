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
        Schema::create('quotas', function (Blueprint $table) {
            $table->id();
            $table->string('description')->nullable(false);
            $table->float('total_price')->nullable(false);
            $table->date('initial_date')->nullable(false);
            $table->date('final_date')->nullable(true);
            $table->float('customer_limit')->nullable(false);
            $table->enum('status', ['ativa', 'inativa']);
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
        Schema::dropIfExists('quotas');
    }
};
