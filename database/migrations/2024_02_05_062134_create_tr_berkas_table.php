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
        Schema::create('tr_berkas', function (Blueprint $table) {
            $table->id('berkas_id');
            $table->unsignedBigInteger('pengajuan_id')->nullable()->foreign('pengajuan_id')->references('pengajuan_id')->on('tr_pengajuan');
            $table->unsignedBigInteger('syarat_id')->nullable()->foreign('syarat_id')->references('syarat_id')->on('syarat_kategori');
            $table->unsignedBigInteger('id_reference')->nullable()->comment('ambil dari user atau pengajuan id');
            $table->string('klasifikasi', 50)->nullable()->comment('isi asn, opd atau instansi lain');
            $table->text('berkas_file')->nullable();
            $table->enum('berkas_status', ['Sesuai', 'Tidak Sesuai', 'Belum Divalidasi'])->nullable();
            $table->text('berkas_catatan')->comment('diisi oleh admin sebagai respon file yg diupload');
            $table->unsignedBigInteger('created_by')->nullable()->foreign('created_by')->references('id')->on('users');
            $table->unsignedBigInteger('updated_by')->nullable()->foreign('updated_by')->references('id')->on('users');
            $table->unsignedBigInteger('changed_by')->nullable();
            $table->timestamp('changed_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tr_berkas');
    }
};
