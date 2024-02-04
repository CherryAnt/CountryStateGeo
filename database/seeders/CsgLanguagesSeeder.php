<?php

namespace Cherryant\CountryStateGeo\Database\Seeders;

use Illuminate\Database\Seeder;

class CsgLanguagesSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Add all countries translations
        $this->call(Languages\PortugueseLanguageSeeder::class);
        $this->call(Languages\SpanishLanguageSeeder::class);
        $this->call(Languages\FrenchLanguageSeeder::class);
        $this->call(Languages\ItalianLanguageSeeder::class);
        $this->call(Languages\ArabicLanguageSeeder::class);
        $this->call(Languages\DutchLanguageSeeder::class);
        $this->call(Languages\GermanLanguageSeeder::class);
        $this->call(Languages\RussianLanguageSeeder::class);
    }
}
