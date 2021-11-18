<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHadithsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hadiths', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedSmallInteger('collection_id');
            $table->unsignedSmallInteger('rabi_id');
            $table->unsignedTinyInteger('value_of_hadith')->nullable()->comment('1=সহিহ, 2=মুনকার, 3=যঈফ, 4=জাল');
            $table->text('arabic')->nullable();
            $table->text('bengali')->nullable();
            $table->text('english')->nullable();
            $table->text('explanation')->nullable();
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
        Schema::dropIfExists('hadiths');
    }
}
