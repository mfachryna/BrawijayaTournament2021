<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->string('type')->default('catur'); //ml,pubg,catur,padus,sinematografi
            $table->string('title')->nullable();
            $table->string('thumbnail')->default('https://picsum.photos/300/200?grayscale');
            $table->string('slug')->unique()->nullable();
            $table->string('status')->default('draft'); //draft, publish
            $table->longText('content')->nullable();
            $table->dateTime('posted_on')->nullable();
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
        Schema::dropIfExists('news');
    }
}
