<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMediaCredit extends Migration
{
    public function up()
    {
        Schema::table('medias', function(Blueprint $table) {
            $table->text('credit')->nullable()->default(null);
        });
    }

    public function down()
    {
        Schema::table('medias', function(Blueprint $table) {
            $table->dropColumn('credit');
        });
    }
}
