<?php
 
namespace Cherryant\CountryStateGeo\Database\Seeders\Countries;

use Illuminate\Database\Seeder;
use Cherryant\CountryStateGeo\Database\Seeders\Builder;

class UM_USMinorOutlyingIslands extends Seeder
{
 
    /**
     * Attribute that defines the language of countries
     *
     * @var string
     */
    public $lang = 'en';
 
    /**
     * Attribute that defines the language of countries
     *
     * @var string
     */
    public $region = 'oceania';
 
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->name = 'U.S. Minor Outlying Islands';
        $this->official_name = 'United States Minor Outlying Islands';
        $this->iso_alpha_2 = 'UM';
        $this->iso_alpha_3 = 'UMI';
        $this->iso_numeric = '581';
        $this->international_phone = '1';
 
        $this->languages = ['en'];
        $this->tld = ['.us'];
        $this->wmo = '0';
        $this->geoname_id = '5854968';
 
        $this->emoji = [
            'img' => '🇺🇲',
            'uCode' => 'U+1F1FA U+1F1F2',
        ];
        $this->color = [
            'hex' => [
            ],
            'rgb' => [
            ],
        ];
        $this->coordinates = [
            'latitude' => [
                'classic' => '',
                'desc' => '19.282319',
            ],
            'longitude' => [
                'classic' => '',
                'desc' => '166.647047',
            ],
        ];
        $this->coordinates_limit = [
            'latitude' => [
                'max' => '28.3977184',
                'min' => '-0.3824678',
            ],
            'longitude' => [
                'max' => '-159.9849071',
                'min' => '166.5989221',
            ],
        ];
 
        $this->geographical = json_decode($this->geographical(), true);
 
        Builder::country($this);
    }
 
    public function geographical()
    {
        return '{"type":"FeatureCollection","features":[{"type":"Feature","properties":{"cca2":"um"},"geometry":{"type":"MultiPolygon","coordinates":[[[[-160.021149,-0.398056],[-160.028107,-0.398056],[-160.039734,-0.395278],[-160.047241,-0.38917],[-160.048615,-0.38361],[-160.041718,-0.376667],[-160.036987,-0.374722],[-160.030853,-0.373889],[-160.017792,-0.374722],[-160.00946,-0.38028],[-160.00946,-0.38917],[-160.010834,-0.394445],[-160.015015,-0.39722],[-160.021149,-0.398056]]],[[[-176.456146,0.21583],[-176.461426,0.215278],[-176.46698,0.216667],[-176.468323,0.22222],[-176.459991,0.2275],[-176.453918,0.226111],[-176.453369,0.22083300000014],[-176.456146,0.21583]]],[[[-176.632202,0.793055],[-176.636169,0.79027800000011],[-176.641693,0.79166700000013],[-176.64447,0.79555],[-176.645844,0.80111100000011],[-176.64505,0.807222],[-176.643097,0.812778],[-176.637512,0.81222],[-176.632751,0.80861],[-176.629974,0.797778],[-176.632202,0.793055]]],[[[-169.522522,16.728882],[-169.53894,16.724159],[-169.543884,16.726379],[-169.542511,16.728882],[-169.537537,16.731106],[-169.531708,16.732491],[-169.52533,16.731663],[-169.522522,16.728882]]],[[[166.646362,19.279442],[166.63916,19.279442],[166.613861,19.297218],[166.607452,19.304996],[166.610504,19.30916],[166.627594,19.32458],[166.648041,19.318607],[166.653046,19.316387],[166.657471,19.31361],[166.660248,19.309441],[166.662201,19.297775],[166.662476,19.284443],[166.65802,19.28194],[166.652191,19.28055],[166.646362,19.279442]]],[[[-177.334442,28.194157],[-177.342224,28.193886],[-177.341675,28.196663],[-177.326111,28.210548],[-177.321686,28.213608],[-177.318054,28.206383],[-177.317505,28.200829],[-177.322266,28.197773],[-177.334442,28.194157]]],[[[-177.388062,28.186378],[-177.393341,28.184158],[-177.395844,28.187492],[-177.389771,28.212769],[-177.386169,28.216385],[-177.376923,28.221104],[-177.370026,28.22193],[-177.363068,28.22166],[-177.358032,28.21916],[-177.362762,28.20583],[-177.366394,28.202213],[-177.388062,28.186378]]]]}}]}';
    }
}
