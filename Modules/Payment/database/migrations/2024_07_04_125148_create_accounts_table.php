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
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->string('account_number', 50)->unique();
            $table->unsignedBigInteger('user_id');
            $table->bigInteger('balance');
            $table->unsignedBigInteger('bank_id');
            $table->string('currency', 3);
            $table->unsignedTinyInteger('status');
            $table->timestamps();

            $table->foreign('bank_id')->references('id')->on('banks');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accounts');
    }
};
