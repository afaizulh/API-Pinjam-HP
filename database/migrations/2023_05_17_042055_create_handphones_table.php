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
        Schema::create('handphones', function (Blueprint $table) {
            $table->id();
            $table->string('phone_name');
            $table->string('status')->enum('AVAILABLE', 'BORROWED')->default('AVAILABLE');
            $table->unsignedBigInteger('owner');
            $table->unsignedBigInteger('borrower')->nullable();
            $table->timestamps();
            
            $table->foreign('owner')->references('id')->on('users');
            $table->foreign('borrower')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('handphones');
    }
};
