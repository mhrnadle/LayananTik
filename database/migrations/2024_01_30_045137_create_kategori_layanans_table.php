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
        Schema::create('kategori_layanan', function (Blueprint $table) {
            $table->id('kl_id')->comment('Primary Key');
            $table->integer('kunker')->nullable()->comment('Ambil Kode OPD Pemangku');
            $table->string('kl_label', 255);
            $table->char('kl_status', 1)->default('0')->comment('0 Non Aktif; 1 Aktif');
            $table->timestamps();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->foreign('updated_by')->references('id')->on('users')
            ->constrained('kategori_layanan')->onDelete('cascade')->onUpdate('cascade');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kategori_layanans');
    }
};
