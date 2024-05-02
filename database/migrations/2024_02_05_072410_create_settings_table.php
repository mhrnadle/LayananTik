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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('setting_name', 200);
            $table->string('setting_var', 50);
            $table->string('setting_val', 200)->nullable();
            $table->text('setting_description');
            $table->enum('setting_type', ['text', 'file', 'textarea']);
            $table->timestamps();
            $table->index('setting_var', 'settings_setting_var_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
