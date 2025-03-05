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
        Schema::create('topic_hadiths', function (Blueprint $table) {
            $table->id();
            $table->foreignId('topic_id')->constrained('topics')->onDelete('cascade'); // Link to Topics
            $table->text('hadith_text_arabic'); // Hadith Text
            $table->text('hadith_text_urdu'); // Hadith Text
            $table->text('hadith_text_english'); // Hadith Text
            $table->text('description')->nullable(); // Custom Description for Hadith
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('topic_hadiths');
    }
};
