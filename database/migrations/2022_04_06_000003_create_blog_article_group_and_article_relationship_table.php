<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('article_groups_and_article', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('article_id');
            $table->unsignedBigInteger('group_id');
            $table->integer('order');
            $table->foreign('article_id')->references('id')->on('blog_articles')->onDelete('cascade');
            $table->foreign('group_id')->references('id')->on('article_groups')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('article_groups_and_article');
    }
};
