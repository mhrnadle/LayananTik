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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username', 200);
            $table->string('name');
            $table->string('email')->unique();
            $table->char('no_telp', 16)->nullable();
            $table->string('alamat')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('avatar')->nullable();
            $table->tinyInteger('is_active')->comment('0 Non Aktif; 1 Aktif')->default(0);
            $table->char('type_akun', 1)->nullable()->comment('1 OPD, 2 User ASN, 3 User Instansi Lain');
            $table->string('nip')->nullable()->comment('Diisi apabila Type_Akun = 2');
            $table->char('id_peg', 20)->nullable()->comment('Ambil dari SIMPEDU sesuai NIP');
            $table->string('kunker', 18)->nullable()->comment('Diisi apabila Type_Akun 1');
            $table->rememberToken();
            $table->integer('created_by')->nullable();
            $table->timestamps();
            $table->integer('updated_by')->nullable();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
