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
        Schema::create('sensus_submissions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('household_id');
            $table->foreign('household_id')->references('id')->on('households')->onDelete('cascade');
            $table->enum('status', ['draft', 'submitted', 'verified',  'rejected'])->default('draft');
            $table->timestamp('submitted_at')->nullable();
            $table->timestamp('verified_at')->nullable();
            $table->unsignedBigInteger('verified_by_id')->nullable();
            $table->foreign('verified_by_id')->references('id')->on('users')->onDelete('cascade');
            $table->text('notes')->nullable();
            $table->year('sensus_year')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sensus_submissions');
    }
};
