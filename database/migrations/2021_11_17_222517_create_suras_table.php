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
            $table->unsignedTinyInteger('sura_number');
            $table->unsignedTinyInteger('revelation_place')->comment('1=Makkah, 2=Madinah');
            $table->unsignedTinyInteger('revelation_order')->nullable();
            $table->boolean('bismillah_pre');
            $table->string('arabic')->nullable();
            $table->string('latin')->nullable();
            $table->string('bengali')->nullable();
            $table->string('english')->nullable();
            $table->unsignedSmallInteger('total_ayah');
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
