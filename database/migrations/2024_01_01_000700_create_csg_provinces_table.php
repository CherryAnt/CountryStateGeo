<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCsgProvincesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('csg_provinces', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('csg_country_id')->unsigned()->index();
            $table->bigInteger('csg_state_id')->unsigned()->index()->nullable();
            $table->string('name');
            $table->string('code');
            $table->json('geo');
            $table->boolean('visible')->default(true);
            $table->timestamps();

            $table->foreign('csg_country_id')->references('id')->on('csg_countries')->onDelete('cascade');
            $table->foreign('csg_state_id')->references('id')->on('csg_states')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('csg_provinces');
    }
}
