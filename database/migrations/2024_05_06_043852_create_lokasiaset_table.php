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
        Schema::create('lokasiaset', function (Blueprint $table) {
            $table->id('lokasiaset_id')->comment('Primary Key');
            $table->unsignedBigInteger('lokasiaset_id')->nullable()->foreign('lokasiaset_id')->references('id')->on('aset');
            $table->text('Deskripsi')->nullable();
            $table->string('kunker', 255)->nullable();
            $table->unsignedBigInteger('created_by')->nullable()->foreign('created_by')->references('id')->on('users');
            $table->unsignedBigInteger('updated_by')->nullable()->foreign('updated_by')->references('id')->on('users');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lokasiaset');
    }
};
