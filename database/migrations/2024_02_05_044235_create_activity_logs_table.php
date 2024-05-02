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
        Schema::create('activity_log', function (Blueprint $table) {
            $table->id('id');
            $table->string('log_name', 200)->nullable();
            $table->text('description');
            $table->string('subject_type', 200)->nullable();
            $table->string('event', 200)->nullable();
            $table->unsignedBigInteger('subject_id')->nullable();
            $table->string('causer_type', 200)->nullable();
            $table->unsignedBigInteger('causer_id')->nullable();
            $table->longText('properties')->nullable();
            $table->char('batch_uuid', 36)->nullable();
            $table->index(['subject_type', 'subject_id'], 'subject');
            $table->index(['causer_type', 'causer_id'], 'causer');
            $table->index('log_name', 'activity_log_log_name_index');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activity_logs');
    }
};
