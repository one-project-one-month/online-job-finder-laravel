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
        Schema::create('job_posts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_id');
            $table->string('title');
            $table->unsignedBigInteger('job_category_id');
            $table->unsignedBigInteger('location_id');
            $table->enum('type',['Remote','Onsite','Hybrid']);
            $table->text('description');
            $table->text('requirements');
            $table->integer('num_of_posts');
            $table->decimal('salary')->nullable();
            $table->string('address')->nullable();
            $table->enum('status',['Open','Close']);
            $table->integer('lock_version');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_posts');
    }
};
