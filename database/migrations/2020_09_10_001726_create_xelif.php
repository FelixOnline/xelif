<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateXelif extends Migration
{
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            createDefaultTableFields($table);
            $table->integer('issue_id')->unsigned()->nullable();
            $table->integer('section_id')->unsigned()->nullable();
            $table->string('headline', 100);
            $table->text('lede')->nullable();
            $table->integer('position')->unsigned()->nullable();
            $table->timestamp('publish_start_date')->nullable();
            $table->timestamp('publish_end_date')->nullable();
        });

        Schema::create('article_slugs', function (Blueprint $table) {
            createDefaultSlugsTableFields($table, 'article');
        });

        Schema::create('article_revisions', function (Blueprint $table) {
            createDefaultRevisionsTableFields($table, 'article');
        });

        Schema::create('issues', function (Blueprint $table) {
            createDefaultTableFields($table);

            $table->integer('issue')->unsigned();
            $table->integer('position')->unsigned()->nullable();

            $table->timestamp('publish_start_date')->nullable();
            $table->timestamp('publish_end_date')->nullable();
        });

        Schema::create('issue_slugs', function (Blueprint $table) {
            createDefaultSlugsTableFields($table, 'issue');
        });

        Schema::create('writers', function (Blueprint $table) {
            createDefaultTableFields($table);
            $table->string('name', 100);
            $table->string('role', 100)->default('Writer');

            $table->text('bio')->nullable();
            $table->boolean('current')->default(true);
        });

        Schema::create('writer_slugs', function (Blueprint $table) {
            createDefaultSlugsTableFields($table, 'writer');
        });

        Schema::create('article_writer', function (Blueprint $table) {
            $table->integer('position')->unsigned();
            $table->integer('article_id')->unsigned();
            $table->integer('writer_id')->unsigned();
        });

        Schema::create('section_writer', function (Blueprint $table) {
            $table->integer('position')->unsigned();
            $table->integer('section_id')->unsigned();
            $table->integer('writer_id')->unsigned();
        });

        Schema::create('sections', function (Blueprint $table) {
            createDefaultTableFields($table);

            $table->string('title', 30);
            $table->string('email', 100)->nullable();
            $table->text('description')->nullable();

            $table->integer('position')->unsigned()->nullable();

            $table->boolean('current')->default(true);
            $table->boolean('featured')->default(true);

            $table->string('colour', 20)->nullable();
        });

        Schema::create('section_slugs', function (Blueprint $table) {
            createDefaultSlugsTableFields($table, 'section');
        });

        Schema::create('article_views', function(Blueprint $table) {
            $table->id();
            $table->foreignId('article_id');
            $table->timestamp('created_at');
            $table->string("ip");
            $table->string("user_agent");
        });
    }

    public function down()
    {
        Schema::dropIfExists('article_views');
        Schema::dropIfExists('section_slugs');
        Schema::dropIfExists('sections');
        Schema::dropIfExists('article_writer');
        Schema::dropIfExists('section_writer');
        Schema::dropIfExists('writer_slugs');
        Schema::dropIfExists('writers');
        Schema::dropIfExists('issue_slugs');
        Schema::dropIfExists('issues');
        Schema::dropIfExists('article_revisions');
        Schema::dropIfExists('article_slugs');
        Schema::dropIfExists('articles');
    }
}
