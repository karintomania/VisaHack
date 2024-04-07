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
        Schema::create('job_links', function (Blueprint $table) {
            $table->id(); // AUTO_INCREMENT PRIMARY KEY
            $table->string('external_id', 255)->unique()->nullable(false);
            $table->string('origin', 63)->nullable(false);
            $table->string('url', 2047)->nullable(false);
            $table->string('country', 8)->nullable(false);
            $table->boolean('has_detail')->nullable(false);
            $table->timestamps(); // created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_links');
    }
};
