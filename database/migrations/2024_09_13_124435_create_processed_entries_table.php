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
        Schema::create('processed_entries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('entry_id')->references('id')->on('entries')->onDelete('cascade');
            $table->foreignId('question_id')->references('id')->on('form_fields')->onDelete('cascade');
            $table->longText('value');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('processed_entries');
    }
};
