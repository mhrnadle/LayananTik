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
        Schema::create('info_layanan', function (Blueprint $table) {
            $table->id('layanan_id')->comment('Primary Key');
            $table->string('kunker_pj', 18)->nullable();
            $table->string('layanan_nama', 255)->nullable();
            $table->string('layanan_slug', 255)->unique();
            $table->text('layanan_desc')->nullable();
            $table->string('layanan_apk', 100)->nullable();
            $table->char('layanan_status', 1)->default('0')->comment('0 Non Aktif, 1 Aktif')->nullable();
            $table->text('layanan_sop')->nullable();
            $table->unsignedBigInteger('created_by')->nullable()->foreign('created_by')->references('id')->on('users');
            $table->unsignedBigInteger('updated_by')->nullable()->foreign('updated_by')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('info_layanans');
    }
};
