<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeArticleViewRecord extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('article_views', function(Blueprint $table) {
            $table->dropColumn('ip');
            $table->string('referer')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('article_views', function(Blueprint $table) {
            $table->string('ip');
            $table->dropColumn('referer');
        });
    }
}
