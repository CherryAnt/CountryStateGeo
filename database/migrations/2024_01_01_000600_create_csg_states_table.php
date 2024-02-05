<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCsgStatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('csg_states', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('csg_country_id')->unsigned();
            $table->string('name');
            $table->string('code');
            $table->boolean('visible')->default(true);
            $table->timestamps();

            $table->foreign('csg_country_id')->references('id')->on('csg_countries')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('csg_states');
    }
}
