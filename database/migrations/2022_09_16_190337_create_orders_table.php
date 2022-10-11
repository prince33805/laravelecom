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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('name')->nullable();
            $table->string('email')->nullable();  
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('totalquantity')->nullable();
            $table->string('totalprice')->nullable();
            $table->string('paymenytype')->nullable();
            $table->string('paymenystatus')->nullable();  
            $table->string('deliverystatus')->nullable();  
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
        Schema::dropIfExists('orders');
    }
};
