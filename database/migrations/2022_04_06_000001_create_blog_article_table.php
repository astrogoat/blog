<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('blog_articles', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('author');
            $table->unsignedBigInteger('category_id')->nullable();
            $table->string('slug');
            $table->string('layout')->nullable();
            $table->unsignedInteger('footer_id')->nullable();
            $table->boolean('indexable');
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
            $table->foreign('footer_id')->references('id')->on('footers');
            $table->foreign('category_id')->references('id')->on('blog_categories');
        });
    }

    public function down()
    {
        Schema::dropIfExists('blog_articles');
    }
};
