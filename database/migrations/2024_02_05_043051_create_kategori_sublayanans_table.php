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
        Schema::create('kategori_sublayanan', function (Blueprint $table) { 
            $table->id('skl_id')->comment('Primary Key');
            $table->unsignedBigInteger('kl_id')->nullable()->foreign('kl_id')->references('id')->on('kategori_layanan');
            $table->string('skl_label', 255)->nullable();
            $table->char('skl_status', 1)->default('0')->comment('0 Non Aktif; 1 Aktif')->nullable();
            $table->string('skl_role', 255)->nullable();
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
        Schema::dropIfExists('kategori_sublayanans');
    }
};
