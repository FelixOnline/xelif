<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePuzzleTeamsTables extends Migration
{
    public function up()
    {
        Schema::create('puzzle_teams', function (Blueprint $table) {
            createDefaultTableFields($table, true, false); // TODO: Php 8 keyword arguments
            $table->string('name', 200);
            $table->integer('points')->default(0);
        });
    }

    public function down()
    {
        Schema::dropIfExists('puzzle_teams');
    }
}
