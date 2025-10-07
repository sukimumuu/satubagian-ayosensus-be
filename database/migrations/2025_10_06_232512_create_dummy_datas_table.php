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
        Schema::create('dummy_datas', function (Blueprint $table) {
            $table->id();
            $table->string('nik', 16)->unique();
            $table->string('phone');
            $table->string('mother_name');
        });

        Schema::create('dummy_jobs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
        });

        Schema::create('dummy_educations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dummy_educations');
        Schema::dropIfExists('dummy_jobs');
        Schema::dropIfExists('dummy_datas');
    }
};
