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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('credit_card_id');
            $table->bigInteger('amount');
            $table->string('client_tracking')->nullable();
            $table->string('currency', 3);
            $table->unsignedTinyInteger('type');
            $table->unsignedTinyInteger('status');
            $table->timestamps();

            $table->foreign('credit_card_id')->references('id')->on('credit_cards');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
