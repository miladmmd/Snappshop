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


        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->string('mobile');
            $table->unsignedBigInteger('provider_id');
            $table->unsignedBigInteger('operator_id');
            $table->unsignedBigInteger('service_id');
            $table->unsignedBigInteger('template_id');
            $table->unsignedTinyInteger('type');
            $table->unsignedTinyInteger('status');
            $table->unsignedTinyInteger('count_try')->nullable();
            $table->json('argument');
            $table->timestamps();

            $table->foreign('provider_id')->references('id')->on('providers');
            $table->foreign('operator_id')->references('id')->on('operators');
            $table->foreign('service_id')->references('id')->on('services');
            $table->foreign('template_id')->references('id')->on('templates');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
