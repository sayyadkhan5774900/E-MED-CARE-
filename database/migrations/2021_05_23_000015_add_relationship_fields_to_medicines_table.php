<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToMedicinesTable extends Migration
{
    public function up()
    {
        Schema::table('medicines', function (Blueprint $table) {
            $table->unsignedBigInteger('pharmacy_id');
            $table->foreign('pharmacy_id', 'pharmacy_fk_3964218')->references('id')->on('pharmacies');
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id', 'category_fk_3950494')->references('id')->on('medicines_categories');
        });
    }
}
