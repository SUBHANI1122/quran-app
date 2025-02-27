<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSurahsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surahs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('number')->unique();
            $table->string('name');
            $table->string('english_name');
            $table->string('english_name_translation');
            $table->integer('number_of_ayahs');
            $table->string('revelation_type');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('surahs');
    }
}
