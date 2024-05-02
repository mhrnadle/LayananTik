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
        Schema::create('views', function (Blueprint $table) {
            $table->id();
            $table->string('viewable_type', 100);
            $table->unsignedBigInteger('viewable_id');
            $table->text('visitor')->nullable();
            $table->string('collection', 100)->nullable();
            $table->timestamp('viewed_at');
            $table->index(['viewable_type', 'viewable_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('views');
    }
};
