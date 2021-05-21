<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCovidPostsTable extends Migration
{
    public function up()
    {
        Schema::create('covid_posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->nullable();
            $table->string('excerpt')->nullable();
            $table->longText('detail')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
