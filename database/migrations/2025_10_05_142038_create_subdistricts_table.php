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
        Schema::create('subdistricts', function (Blueprint $table) {
            $table->integer('kode')->primary();
            $table->string('name');
            $table->timestamps();
        });
        Schema::create('villages', function (Blueprint $table) {
            $table->bigInteger('kode')->primary();
            $table->string('name');
            $table->integer('subdistrict_kode');
            $table->foreign('subdistrict_kode')->references('kode')->on('subdistricts');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('villages');
        Schema::dropIfExists('subdistricts');
    }
};
