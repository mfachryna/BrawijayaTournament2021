<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlayersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('players', function (Blueprint $table) {
            $table->id();
            $table->integer('team_id');
            $table->string('competition_name');
            $table->string('nim');
            $table->string('nama');
            $table->string('faculty');
            $table->string('angkatan')->nullable();
            $table->string('avatar');
            $table->string('ktm');
            $table->string('krs');

            // ML
            $table->string('nickname')->nullable();
            $table->string('email')->nullable();
            $table->string('handphone')->nullable();

            // PUBG
            $table->string('game_id')->nullable();

            // PADUS
            $table->string('posisi')->nullable();

            //CATUR CEPAT & CATUR KILAT
            $table->string('gender')->nullable();
            $table->integer('no_pertandingan')->nullable();

            $table->unique(['competition_name', 'nim']);

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
        Schema::dropIfExists('players');
    }
}
