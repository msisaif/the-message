<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->smallIncrements('id');
            $table->unsignedTinyInteger('sura_number');
            $table->unsignedSmallInteger('position');
            $table->string('key')->comment('sura_number:position');
            $table->unsignedSmallInteger('ayah_number');
            $table->unsignedTinyInteger('juz_number');
            $table->unsignedSmallInteger('page_number');
            $table->boolean('sajdah');
            $table->text('text');
            $table->softDeletes();
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
