<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCsgCountriesGeographicalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('csg_countries_geographical', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->bigInteger('csg_country_id')->unsigned()->index();
            $table->string('type');
            $table->string('features_type');
            $table->json('properties');
            $table->json('geometry');

            $table->foreign('csg_country_id')->references('id')->on('csg_countries')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('csg_countries_geographical');
    }
}
