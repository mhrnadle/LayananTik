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
        Schema::create('aset', function (Blueprint $table) {
            Schema::create('aset', function (Blueprint $table) {
                $table->id('aset_id')->comment('Primary Key');
                $table->string('NamaAset', 255)->nullable();
                $table->string('JenisAset', 255)->nullable();
                $table->text('Deskripsi')->nullable();
                $table->unsignedBigInteger('IDLokasi', 255)->unique()->foreign('IDLokasi')->references('id')->on('lokasiaset');
                $table->unsignedBigInteger('IDKategori', 255)->unique()->foreign('IDKategori')->references('id')->on('kategoriaset');;
                $table->char('Kondisi', 1)->default('0')->comment('0 Non Aktif, 1 Aktif')->nullable();
                $table->date('TanggalPembelian')->nullable();
                $table->integer('NilaiAset')->nullable();
                $table->unsignedBigInteger('created_by')->nullable()->foreign('created_by')->references('id')->on('users');
                $table->unsignedBigInteger('updated_by')->nullable()->foreign('updated_by')->references('id')->on('users');
                $table->timestamps();
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aset');
    }
};
