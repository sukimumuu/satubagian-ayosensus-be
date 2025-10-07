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
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('no_kk')->unique();
            $table->text('address');
            $table->string('rw', 3);
            $table->string('rt', 3);
            $table->bigInteger('kode_desa');
            $table->foreign('kode_desa')->references('kode')->on('villages')->onDelete('cascade');
            $table->string('zipcode', 5);
            $table->timestamps();
        });

        Schema::create('individuals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('household_id');
            $table->foreign('household_id')->references('id')->on('households')->onDelete('cascade');
            $table->string('full_name');
            $table->string('nik', 16)->unique();
            $table->text('address');
            $table->integer('stay');
            $table->enum('gender', ['male', 'female']);
            $table->date('birth_place');
            $table->date('birth_date');
            $table->enum('nationality', ['wni', 'wna']);
            $table->string('tribes');
            $table->enum('religion', ['islam', 'kristen', 'katolik', 'hindu', 'budha', 'konghucu', 'lainnya']);
            $table->string('used_language');
            $table->string('family_status', 20);
            $table->enum('marital_status', ['married', 'single']);
            $table->timestamps();
        });

        Schema::create('works', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('individual_id');
            $table->foreign('individual_id')->references('id')->on('individuals')->onDelete('cascade');
            $table->string('activity');
            $table->string('job');
            $table->string('job_status');
            $table->timestamps();
        });

        Schema::create('educations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('individual_id');
            $table->foreign('individual_id')->references('id')->on('individuals')->onDelete('cascade');
            $table->string('education');
            $table->timestamps();
        });

        Schema::create('housings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('household_id');
            $table->foreign('household_id')->references('id')->on('households')->onDelete('cascade');
            $table->string('ownership_status');
            $table->string('electricity');
            $table->string('water');
            $table->string('toilet');
            $table->string('floor');
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
