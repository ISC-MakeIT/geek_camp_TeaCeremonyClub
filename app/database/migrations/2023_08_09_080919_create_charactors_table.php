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
        Schema::create('charactors', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->string('name',255);
            $table->string('sex', 6);
            $table->string('icon', 2046);
            $table->integer('extraversion');
            $table->integer('agreeableness');
            $table->integer('conscientiousness');
            $table->integer('neuroticism');
            $table->integer('openness');
            $table->foreignId('creator');
            $table->foreignId('updater');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('characters');
    }
};
