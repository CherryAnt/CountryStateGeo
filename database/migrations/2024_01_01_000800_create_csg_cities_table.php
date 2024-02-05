<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCsgCitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('csg_cities', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('csg_country_id')->unsigned()->index();
            $table->bigInteger('csg_state_id')->unsigned()->index()->nullable();
            $table->bigInteger('csg_province_id')->unsigned()->index()->nullable();
            $table->string('name');
            $table->json('cp');
            $table->float('lat', 10, 6);
            $table->float('lng', 10, 6);
            $table->boolean('visible')->default(true);
            $table->timestamps();

            $table->foreign('csg_country_id')->references('id')->on('csg_countries')->onDelete('cascade');
            $table->foreign('csg_state_id')->references('id')->on('csg_states')->onDelete('cascade');
            $table->foreign('csg_province_id')->references('id')->on('csg_provinces')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('csg_cities');
    }
}
