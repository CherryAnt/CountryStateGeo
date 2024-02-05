<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCsgCountriesTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('csg_countries_translations', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('csg_country_id')->unsigned()->index();
            $table->string('name');
            $table->string('slug');
            $table->string('locale')->index();

            $table->unique(['csg_country_id', 'locale']);
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
        Schema::dropIfExists('csg_countries_translations');
    }
}
