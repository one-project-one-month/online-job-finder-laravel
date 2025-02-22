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
        Schema::create('applicant_job_categories', function (Blueprint $table) {
            $table->id(); // BIGINT UNSIGNED with auto-increment (Primary Key)
            $table->foreignId('applicant_id')->constrained('applicant_profiles')->onDelete('cascade'); // Foreign Key
            $table->foreignId('job_category_id')->constrained('job_categories')->onDelete('cascade'); // Foreign Key
            $table->integer('lock_version')->default(0); // Version with default value
            $table->timestamps(); // created_at and updated_at (nullable by default)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applicant_job_categories');
    }
};
