<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCsgRegionTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('csg_region_translations', function (Blueprint $table) {
            $table->tinyIncrements('id');
            $table->tinyInteger('csg_region_id')->unsigned();
            $table->string('name');
            $table->string('slug');
            $table->string('locale')->index();

            $table->unique(['csg_region_id', 'locale']);
            $table->unique(['slug', 'locale']);
            $table->foreign('csg_region_id')->references('id')->on('csg_regions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('csg_region_translations');
    }
}