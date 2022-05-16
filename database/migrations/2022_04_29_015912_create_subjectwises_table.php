<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubjectwisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subjectwises', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('category_id')->index();
            $table->unsignedTinyInteger('type')->comment('1=Ayah, 2=Hadith');
            $table->text('title')->nullable();
            $table->text('arabic')->nullable();
            $table->text('bengali')->nullable();
            $table->timestamps();
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
        Schema::dropIfExists('subjectwises');
    }
}
