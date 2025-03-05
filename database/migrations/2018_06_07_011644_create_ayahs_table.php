<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAyahsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ayahs', function (Blueprint $table) {
            $table->id();
            $table->integer('ayah_number')->unique();
            $table->integer('surah_number');
            $table->text('text');
            $table->string('audio')->nullable();
            $table->integer('number_in_surah');
            $table->integer('juz');
            $table->integer('manzil');
            $table->integer('page');
            $table->integer('ruku');
            $table->integer('hizb_quarter');
            $table->boolean('sajda');
            $table->timestamps();

            $table->foreign('surah_number')->references('number')->on('surahs')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ayahs');
    }
}
