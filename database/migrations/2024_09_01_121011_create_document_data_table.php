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
        Schema::create('document_data', function (Blueprint $table) {
            $table->id();
            $table->string('document_name');
            $table->string("name")->nullable();
            $table->string('company')->nullable();
            $table->string('email')->nullable();
            $table->string('contact')->nullable();
            $table->string('location')->nullable();
            $table->string('position')->nullable();
            $table->string('employer')->nullable();
            $table->string('office_number')->nullable();
            $table->foreignId('document_id')->references('id')->on('documents')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('document_data');
    }
};
