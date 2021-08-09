<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOfficialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('officials', function (Blueprint $table) {
            $table->id();
            $table->integer('team_id');
            $table->string('competition_name');
            $table->string('nim');
            $table->string('nama');
            $table->string('email');
            $table->string('handphone');
            $table->string('faculty')->nullable();
            $table->string('angkatan')->nullable();
            $table->string('avatar');
            $table->string('ktm');
            $table->string('krs')->nullable();
            $table->string('university')->nullable();
            $table->integer('no_pertandingan')->nullable();
            $table->timestamps();

            $table->unique(['competition_name', 'nim']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('officials');
    }
}
