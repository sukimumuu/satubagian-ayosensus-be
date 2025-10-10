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
        Schema::create('households', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->unique();
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('no_kk')->unique()->nullable();
            $table->text('address')->nullable();
            $table->string('rw', 3)->nullable();
            $table->string('rt', 3)->nullable();
            $table->bigInteger('kode_desa');
            $table->foreign('kode_desa')->references('kode')->on('villages');
            $table->string('zipcode', 5)->nullable();
            $table->timestamps();
        });

        Schema::create('individuals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('household_id');
            $table->foreign('household_id')->references('id')->on('households');
            $table->string('full_name')->nullable();
            $table->string('nik', 16)->nullable()->unique();
            $table->text('address')->nullable();
            $table->integer('stay')->nullable();
            $table->enum('gender', ['male', 'female'])->nullable();
            $table->string('birth_place')->nullable();
            $table->date('birth_date')->nullable();
            $table->enum('nationality', ['wni', 'wna'])->nullable();
            $table->string('tribes')->nullable();
            $table->enum('religion', ['islam', 'kristen', 'katolik', 'hindu', 'budha', 'konghucu', 'lainnya'])->nullable();
            $table->string('used_language')->nullable();
            $table->string('family_status', 20)->nullable();
            $table->enum('marital_status', ['married', 'single'])->nullable();
            $table->timestamps();
        });

        Schema::create('works', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('individual_id')->nullable();
            $table->foreign('individual_id')->references('id')->on('individuals');
            $table->string('activity')->nullable();
            $table->string('job')->nullable();
            $table->string('job_status')->nullable();
            $table->timestamps();
        });

        Schema::create('educations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('individual_id')->nullable();
            $table->foreign('individual_id')->references('id')->on('individuals');
            $table->string('education')->nullable();
            $table->timestamps();
        });

        Schema::create('housings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('household_id')->nullable();
            $table->foreign('household_id')->references('id')->on('households');
            $table->string('ownership_status')->nullable();
            $table->string('electricity')->nullable();
            $table->string('water')->nullable();
            $table->string('toilet')->nullable();
            $table->string('floor')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('housings');
        Schema::dropIfExists('educations');
        Schema::dropIfExists('works');
        Schema::dropIfExists('individuals');
        Schema::dropIfExists('households');
    }
};
