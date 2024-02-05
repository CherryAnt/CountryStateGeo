<?php

namespace Cherryant\CountryStateGeo\Database\Seeders;

use Cherryant\CountryStateGeo\Models\City;
use Cherryant\CountryStateGeo\Models\Province;
use Cherryant\CountryStateGeo\Models\State;
use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Cherryant\CountryStateGeo\Models\Country;
use Cherryant\CountryStateGeo\Models\CountryRegion;
use Cherryant\CountryStateGeo\Models\CountryRegionTranslation;
use Cherryant\CountryStateGeo\Models\CountryTranslation;

class Builder
{
    public static function country(Seeder $country): void
    {
        $region = CountryRegion::whereSlug($country->region, $country->lang)
            ->firstOrFail();

        $_country = $region->countries()->create([
            'official_name' => $country->official_name,
            'iso_alpha_2' => $country->iso_alpha_2,
            'iso_alpha_3' => $country->iso_alpha_3,
            'iso_numeric' => $country->iso_numeric,
            'international_phone' => $country->international_phone,
            'languages' => json_encode($country->languages),
            'tld' => json_encode($country->tld),
            'wmo' => $country->wmo,
            'geoname_id' => $country->geoname_id,
            'emoji' => json_encode($country->emoji),
            'color_hex' => json_encode($country->color['hex']),
            'color_rgb' => json_encode($country->color['rgb']),
            'coordinates' => json_encode($country->coordinates),
            'coordinates_limit' => json_encode($country->coordinates_limit),
            'visible' => true,
            'en' => [
                'name' => $country->name,
                'slug' => Str::slug($country->name, '-'),
            ],
        ]);

        $geographical = $country->geographical;
        if (isset($geographical['type'])) {
            $_country->geographical()->create([
                'type' => $geographical['type'],
                'features_type' => $geographical['features'][0]['type'],
                'properties' => json_encode($geographical['features'][0]['properties']),
                'geometry' => json_encode($geographical['features'][0]['geometry']),
            ]);
        }
    }

    public static function regions(): void
    {
        $regions = [
            'Africa',
            'Americas',
            'Asia',
            'Europe',
            'Oceania',
        ];

        foreach ($regions as $region) {
            CountryRegion::create([
                'en' => [
                    'slug' => Str::slug($region, '-'),
                    'name' => Str::title(trim($region)),
                ],
            ]);
        }

        return;
    }

    public static function regionsTranslations(array $regions, String $lang): void
    {
        DB::beginTransaction();

        foreach ($regions as $slug => $region) {
            $response = CountryRegion::whereTranslation('locale', 'en')
                ->whereTranslation('name', $slug)
                ->first();

            if ($response == null) {
                DB::rollBack();
                throw new Exception('Region ' . $region . ' not found');
            }

            CountryRegionTranslation::create([
                'csg_region_id' => $response->id,
                'locale' => $lang,
                'slug' => Str::slug($region, '-'),
                'name' => Str::title(trim($region)),
            ]);
        }

        DB::commit();
        return;
    }

    public static function countriesTranslations(array $countries, String $lang): void
    {
        DB::beginTransaction();

        foreach ($countries as $iso => $country) {
            $response = Country::where('iso_alpha_2', $iso)
                ->orWhere('iso_alpha_3', $iso)
                ->orWhere('iso_numeric', $iso)
                ->first();

            if ($response == null) {
                continue;
            }

            CountryTranslation::create([
                'csg_country_id' => $response->id,
                'locale' => $lang,
                'slug' => Str::slug($country, '-'),
                'name' => Str::title(trim($country)),
            ]);
        }

        DB::commit();
        return;
    }

    public static function states(): void
    {
        $_isos = ['AO','BF','BI','BJ','BW','CD','CF','CG','CI','CM','CV','DJ','DZ','EG','EH','ER','ET','GA','GH','GM','GN','GQ','GW','KE','KM','LR','LS','LY','MA','MG','ML','MR','MU','MW','MZ','NA','NE','NG','RE','RW','SC','SD','SH','SL','SN','SO','ST','SZ','TD','TG','TN','TZ','UG','YT','ZA','ZM','ZW','AG','AI','AR','AW','BB','BL','BM','BO','BR','BS','BZ','CA','CL','CO','CR','CU','DM','DO','EC','FK','GD','GF','GL','GP','GT','GY','HN','HT','JM','KN','KY','LC','MF','MQ','MS','MX','NI','PA','PE','PM','PR','PY','SR','SV','TC','TT','US','UY','VC','VE','VG','VI','AE','AF','AM','AZ','BD','BH','BN','BT','CN','GE','HK','ID','IL','IN','IQ','IR','JO','JP','KG','KH','KP','KR','KW','KZ','LA','LB','LK','MM','MN','MO','MV','MY','NP','OM','PH','PK','PS','QA','SA','SG','SY','TH','TJ','TL','TM','TR','TW','UZ','VN','YE','AD','AL','AT','AX','BA','BE','BG','BY','CH','CY','CZ','DE','DK','EE','ES','FI','FO','FR','GB','GG','GI','GR','HR','HU','IE','IM','IS','IT','JE','LI','LT','LU','LV','MC','MD','ME','MK','MT','NL','NO','PL','PT','RO','RS','RU','SE'];
        foreach ($_isos as $iso){
            $iso= strtolower($iso);
            $country = Country::whereIso(strtoupper($iso))
                ->firstOrFail();

            if(File::exists(__DIR__ . "/../data/states/".$iso.".json")){
                $jsonStates = File::get(__DIR__ . "/../data/states/".$iso.".json");
                $states = json_decode($jsonStates);
                foreach ($states as $state) {
                    State::create([
                        "csg_country_id" => $country->id,
                        "code" => $state->code,
                        "name" => $state->name,
                        'visible' => true,
                    ]);
                }
            }
        }
    }

    public static function provinces(): void
    {
        $_isos = ['AO','BF','BI','BJ','BW','CD','CF','CG','CI','CM','CV','DJ','DZ','EG','EH','ER','ET','GA','GH','GM','GN','GQ','GW','KE','KM','LR','LS','LY','MA','MG','ML','MR','MU','MW','MZ','NA','NE','NG','RE','RW','SC','SD','SH','SL','SN','SO','ST','SZ','TD','TG','TN','TZ','UG','YT','ZA','ZM','ZW','AG','AI','AR','AW','BB','BL','BM','BO','BR','BS','BZ','CA','CL','CO','CR','CU','DM','DO','EC','FK','GD','GF','GL','GP','GT','GY','HN','HT','JM','KN','KY','LC','MF','MQ','MS','MX','NI','PA','PE','PM','PR','PY','SR','SV','TC','TT','US','UY','VC','VE','VG','VI','AE','AF','AM','AZ','BD','BH','BN','BT','CN','GE','HK','ID','IL','IN','IQ','IR','JO','JP','KG','KH','KP','KR','KW','KZ','LA','LB','LK','MM','MN','MO','MV','MY','NP','OM','PH','PK','PS','QA','SA','SG','SY','TH','TJ','TL','TM','TR','TW','UZ','VN','YE','AD','AL','AT','AX','BA','BE','BG','BY','CH','CY','CZ','DE','DK','EE','ES','FI','FO','FR','GB','GG','GI','GR','HR','HU','IE','IM','IS','IT','JE','LI','LT','LU','LV','MC','MD','ME','MK','MT','NL','NO','PL','PT','RO','RS','RU','SE'];
        foreach ($_isos as $iso){
            $iso= strtolower($iso);
            $country = Country::whereIso(strtoupper($iso))
                ->firstOrFail();

            if(File::exists(__DIR__ . "/../data/provinces/".$iso.".json")){
                $jsonProvinces = File::get(__DIR__ . "/../data/provinces/".$iso.".json");
                $provinces = json_decode($jsonProvinces);
                $states_codes = [];
                foreach ($provinces as $province) {
                    if($province->name==null) continue;
                    $stateId = null;
                    if($province->state_code!=''){
                        if(!array_key_exists($province->state_code, $states_codes)){
                            $state = State::where([
                                'csg_country_id'=>$country->id,
                                'code'=>$province->state_code
                            ])->firstOrFail();
                            $stateId = $state->id;
                            $states_codes[$province->state_code] = $stateId;
                        }else{
                            $stateId = $states_codes[$province->state_code];
                        }
                    }
                    Province::create([
                        "csg_country_id" => $country->id,
                        "csg_state_id" => $stateId,
                        "code" => $province->code,
                        "name" => $province->name,
                        'geo' => json_encode($province->geo),
                        'visible' => true,
                    ]);
                }
            }
        }
    }

    public static function cities(): void
    {
        $_isos = ['AO','BF','BI','BJ','BW','CD','CF','CG','CI','CM','CV','DJ','DZ','EG','EH','ER','ET','GA','GH','GM','GN','GQ','GW','KE','KM','LR','LS','LY','MA','MG','ML','MR','MU','MW','MZ','NA','NE','NG','RE','RW','SC','SD','SH','SL','SN','SO','ST','SZ','TD','TG','TN','TZ','UG','YT','ZA','ZM','ZW','AG','AI','AR','AW','BB','BL','BM','BO','BR','BS','BZ','CA','CL','CO','CR','CU','DM','DO','EC','FK','GD','GF','GL','GP','GT','GY','HN','HT','JM','KN','KY','LC','MF','MQ','MS','MX','NI','PA','PE','PM','PR','PY','SR','SV','TC','TT','US','UY','VC','VE','VG','VI','AE','AF','AM','AZ','BD','BH','BN','BT','CN','GE','HK','ID','IL','IN','IQ','IR','JO','JP','KG','KH','KP','KR','KW','KZ','LA','LB','LK','MM','MN','MO','MV','MY','NP','OM','PH','PK','PS','QA','SA','SG','SY','TH','TJ','TL','TM','TR','TW','UZ','VN','YE','AD','AL','AT','AX','BA','BE','BG','BY','CH','CY','CZ','DE','DK','EE','ES','FI','FO','FR','GB','GG','GI','GR','HR','HU','IE','IM','IS','IT','JE','LI','LT','LU','LV','MC','MD','ME','MK','MT','NL','NO','PL','PT','RO','RS','RU','SE'];
        foreach ($_isos as $iso){
            $iso= strtolower($iso);
            $country = Country::whereIso(strtoupper($iso))
                ->firstOrFail();

            if(File::exists(__DIR__ . "/../data/cities/".$iso.".json")){
                $jsonCities = File::get(__DIR__ . "/../data/cities/".$iso.".json");
                $cities = json_decode($jsonCities);
                $states_codes = [];
                $provinces_codes = [];
                foreach ($cities as $city) {
                    if($city->name==null) continue;
                    $stateId = null;
                    $provinceId = null;
                    if($city->province_code!=''){
                        if(!array_key_exists($city->province_code, $provinces_codes)){
                            $province = Province::where([
                                'csg_country_id'=>$country->id,
                                'code'=>$city->province_code
                            ])->first();
                            if($province){
                            $provinceId = $province->id;
                            $provinces_codes[$city->province_code] = $provinceId;
                            }
                        }else{
                            $provinceId = $provinces_codes[$city->province_code];
                        }
                    }
                    if($city->state_code!=''){
                        if(!array_key_exists($city->state_code, $states_codes)){
                            $state = State::where([
                                'csg_country_id'=>$country->id,
                                'code'=>$city->state_code
                            ])->first();
                            if($state){
                            $stateId = $state->id;
                            $states_codes[$city->state_code] = $stateId;
                            }
                        }else{
                            $stateId = $states_codes[$city->state_code];
                        }
                    }
                    City::create([
                        "csg_country_id" => $country->id,
                        "csg_state_id" => $stateId,
                        "csg_province_id" => $provinceId,
                        "name" => $city->name,
                        "cp" => $city->cp,
                        'lat' => (float)$city->lat,
                        'lng' => (float)$city->lng,
                        'visible' => true,
                    ]);
                }
            }
        }
    }
}