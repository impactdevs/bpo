<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormFieldsTable extends Migration
{
    public function up()
    {
        Schema::create('form_fields', function (Blueprint $table) {
            $table->id();
            //$table->uuid('form_id');
            // $table->foreign('form_id')->references('id')->on('forms')->onDelete('cascade');
            $table->foreignId('form_id')->constrained();
            $table->string('label');
            $table->string('type'); // Example: text, textarea, checkbox, radio, select, etc.
            $table->text('options')->nullable(); // JSON or text to store additional options (e.g., for select options)
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('form_fields');
    }
}
