<?php

use App\Models\Store;
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
        Schema::create('sorts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('store_id')->nullable()->constrained('stores', 'id')->default(null);
            $table->string('award')->nullable()->default(null);
            $table->enum('type', ['geral', 'loja']);
            $table->string('description');
            $table->string('image')->nullable();
            $table->date('initial_date')->default(date('Y-m-d'));
            $table->date('final_date')->default(date('Y-m-d'));
            $table->date('draw_date')->default(date('Y-m-d'));
            $table->boolean('active')->default(true);
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
        Schema::dropIfExists('sorts');
    }
};
