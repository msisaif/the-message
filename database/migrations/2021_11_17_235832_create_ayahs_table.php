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
            $table->unsignedTinyInteger('sura_number')->nullable();
            $table->unsignedSmallInteger('position')->nullable();
            $table->string('key')->comment('sura_number:position')->nullable();
            $table->unsignedSmallInteger('ayah_number')->nullable();
            $table->unsignedTinyInteger('juz_number')->nullable();
            $table->unsignedSmallInteger('page_number')->nullable();
            $table->boolean('sajdah')->nullable();
            $table->text('text')->nullable();
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
