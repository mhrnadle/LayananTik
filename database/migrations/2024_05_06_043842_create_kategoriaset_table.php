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
        Schema::create('kategoriaset', function (Blueprint $table) {
            $table->id('kategoriaset_id')->comment('Primary Key');
            $table->unsignedBigInteger('kategoriaset_id')->nullable()->foreign('kategoriaset_id')->references('id')->on('aset');
            $table->string('namakategori', 255)->nullable();
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
        Schema::dropIfExists('kategoriaset');
    }
};
