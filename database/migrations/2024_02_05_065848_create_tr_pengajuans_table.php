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
        Schema::create('tr_pengajuan', function (Blueprint $table) {
            $table->id('pengajuan_id');
            $table->unsignedBigInteger('skl_id')->nullable()->foreign('skl_id')->references('skl_id')->on('kategori_sublayanan');
            $table->unsignedBigInteger('users_id')->nullable()->foreign('users_id')->references('id')->on('users');
            $table->text('pengajuan_detail')->nullable();
            $table->enum('pengajuan_status', ['Menunggu', 'Diproses', 'Ditolak', 'Selesai'])->default('Menunggu')->nullable()->comment('Diisi Oleh Admin, Default Menunggu');
            $table->text('pengajuan_catatan')->nullable()->comment('Diisi Oleh Admin');
            $table->unsignedBigInteger('created_by')->nullable()->foreign('created_by')->references('id')->on('users');
            $table->unsignedBigInteger('updated_by')->nullable()->foreign('updated_by')->references('id')->on('users');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tr_pengajuans');
    }
};
