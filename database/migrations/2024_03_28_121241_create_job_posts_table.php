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
            $table->string('external_id', 255)->unique()->nullable(false);
            $table->string('origin', 63)->nullable(false);
            $table->string('title', 127)->nullable(false);
            $table->string('company', 127)->nullable(false);
            $table->string('url', 2047)->nullable(false);
            $table->string('country', 8)->nullable(false);
            $table->string('salary', 127)->nullable(true);
            $table->string('location', 127)->nullable(true);
            $table->string('job_type', 127)->nullable(false);
            $table->text('description')->nullable(false);
            $table->boolean('active')->nullable(false);
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
