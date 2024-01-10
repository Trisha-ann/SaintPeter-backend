<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id('payment_id')->autoIncrement();
            $table->integer('customers_id')->references('customers_id')->on('customers');
            $table->integer('plan_id')->references('plan_id')->on('plans');
            $table->string('employee_id')->references('employee_id')->on('employees');
            $table->float('purchased_payable');
            $table->float('amount_received');
            $table->float('balance');
            $table->string('payment_duration');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
