<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToBrandsTable extends Migration
{
    public function up()
    {
        Schema::table('brands', function (Blueprint $table) {
            $table->unsignedBigInteger('pharmacy_id');
            $table->foreign('pharmacy_id', 'pharmacy_fk_3968123')->references('id')->on('pharmacies');
        });
    }
}
