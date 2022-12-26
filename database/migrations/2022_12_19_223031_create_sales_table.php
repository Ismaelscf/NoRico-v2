<?php

use App\Models\Store;
use App\Models\StoreEmployee;
use App\Models\User;
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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->foreignId('store_id')->constrained('stores', 'id');
            $table->foreignId('employee_id')->constrained('store_employees', 'id');
            $table->foreignId('user_id')->constrained('users', 'id');
            $table->float('total_sale');
            $table->float('discount')->nullable()->default(null);
            $table->date('sale_date');
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
        Schema::dropIfExists('sales');
    }
};
