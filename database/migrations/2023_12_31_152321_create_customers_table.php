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
        Schema::create('customers', function (Blueprint $table) {
            $table->id('customers_id')->autoIncrement();
            $table->string('last_name');
            $table->string('first_name');
            $table->string('address');
            $table->integer('age');
            $table->string('gender');
            $table>date('birth_date');
            $table->date('death_date')->nullable();
            $table->string('employee_id');
            $table->timestamps();
        });

        Schema::table('customers', function (Blueprint $table) {
            $table->foreign('employee_id')->references('employee_id')->on('employees');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
