<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSurasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suras', function (Blueprint $table) {
            $table->tinyIncrements('id');
            $table->unsignedTinyInteger('sura_number')->nullable();
            $table->unsignedSmallInteger('total_ayah')->nullable();
            $table->boolean('bismillah_pre')->nullable();
            $table->unsignedTinyInteger('revelation_place')->nullable()->comment('1=Makkah, 2=Madinah');
            $table->unsignedTinyInteger('revelation_order')->nullable();
            $table->string('arabic')->nullable();
            $table->string('bengali_meaning')->nullable();
            $table->string('bengali_pronunciation')->nullable();
            $table->string('english_meaning')->nullable();
            $table->string('english_pronunciation')->nullable();
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
        Schema::dropIfExists('suras');
    }
}
