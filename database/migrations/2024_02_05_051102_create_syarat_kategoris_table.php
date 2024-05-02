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
        Schema::create('syarat_kategori', function (Blueprint $table) {
            $table->id('syarat_id');
            $table->string('syarat_label', 200);
            $table->unsignedBigInteger('syarat_kategori_id')->nullable()->foreign('skl_id')->references('skl_id')->on('kategori_sublayanan');
            $table->enum('syarat_type', ['Umum', 'Khusus'])->nullable();
            $table->string('syarat_type_file', 100);
            $table->boolean('syarat_status')->default(1)->comment('0: nonaktif, 1: aktif');
            $table->text('syarat_template')->nullable()->comment('isi file template');
            $table->unsignedBigInteger('created_by')->nullable()->foreign('created_by')->references('id')->on('users');
            $table->unsignedBigInteger('updated_by')->nullable()->foreign('updated_by')->references('id')->on('users');
            $table->timestamps();
            $table->index('syarat_kategori_id', 'syarat_kategori_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('syarat_kategori');
    }
};
