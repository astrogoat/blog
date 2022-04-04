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
            $table->string('image');
            $table->string('category');
            $table->string('slug');
            $table->string('layout')->nullable();
            $table->unsignedInteger('footer_id')->nullable();
            $table->timestamps();
        });
    }
};
