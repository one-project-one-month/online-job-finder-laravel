<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */

    //  Table job_skills {
    //     id varchar [primary key]
    //     job_id varchar
    //     skill_id varchar
    //     version int
    //     created_at timestamp
    //     updated_at timestamp
    //   }
    public function up(): void
    {
        Schema::create('job_skills', function (Blueprint $table) {
            $table->id();
            $table->integer('job_post_id');
            $table->integer('skill_id');
            $table->integer('lock_version')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_skills');
    }
};
