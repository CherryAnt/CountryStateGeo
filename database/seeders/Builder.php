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
        $_isos = ["fr","li","be","ci","tf","nl","dz","gp","lv","mu","tn","td","at","md","mh","er","kw","sm","kp","pl","se","tl","sk","kz","mx","tz","my","dk","si","ee","th","ad","sj","ru","tr","rs","cf","sg","nz","so","iq","sl","ca","bz","sh","bs","pe","vi","it","vu","km","lb","lt","rw","fj","cn","ro","ph","mq","mw","nc","uy","gt","bm","na","hu","do","ae","bw","pm","gm","bb","dm","gr","re","by","lk","gb","ua","sc","la","mm","mc","fm","zm","bg","ke","ie","ve","id","pt","kg","jp","vn","nr","lu","ly","co","al","gd","mg","im","ba","vc","br","va","kh","ki","cd","az","eg","kr","dj","ch","sy","il","is","sn","cz","cl","pa","za","ir","mp","de","tj","je","ax","ug","ws","cu","ec","au","sr","cr","mk","gh","pk","pg","ye","in","bh","cv","np","tm","mn","mr","us","no","ag","ni","bd","pr","jo","cy","fi","ls","et","ma","zw","sv","sa","bo","bf","qa","hr","ky","as","kn","yt","ng","gu","uz","af","cg","ml","cm","am","me","ar","gn","fo","es","pw","gg","gy","bn","hn","ne","tt","tw","wf","to","bj","aq","mt","mz","bi","gq","eh","gl","tg","tv","sb","lr","ao","bq","ga","bt","py","sd","st","gw","um","jm","gf","om","mv","ge","ht","sz"];
        foreach ($_isos as $iso){
            $country = Country::whereIso(strtoupper($iso))
                ->firstOrFail();

            if(File::exists("database/json/states/".$iso.".json")){
                $jsonStates = File::get("database/json/states/".$iso.".json");
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
        $_isos = ["fr","li","be","ci","tf","nl","dz","gp","lv","mu","tn","td","at","md","mh","er","kw","sm","kp","pl","se","tl","sk","kz","mx","tz","my","dk","si","ee","th","ad","sj","ru","tr","rs","cf","sg","nz","so","iq","sl","ca","bz","sh","bs","pe","vi","it","vu","km","lb","lt","rw","fj","cn","ro","ph","mq","mw","nc","uy","gt","bm","na","hu","do","ae","bw","pm","gm","bb","dm","gr","re","by","lk","gb","ua","sc","la","mm","mc","fm","zm","bg","ke","ie","ve","id","pt","kg","jp","vn","nr","lu","ly","co","al","gd","mg","im","ba","vc","br","va","kh","ki","cd","az","eg","kr","dj","ch","sy","il","is","sn","cz","cl","pa","za","ir","mp","de","tj","je","ax","ug","ws","cu","ec","au","sr","cr","mk","gh","pk","pg","ye","in","bh","cv","np","tm","mn","mr","us","no","ag","ni","bd","pr","jo","cy","fi","ls","et","ma","zw","sv","sa","bo","bf","qa","hr","ky","as","kn","yt","ng","gu","uz","af","cg","ml","cm","am","me","ar","gn","fo","es","pw","gg","gy","bn","hn","ne","tt","tw","wf","to","bj","aq","mt","mz","bi","gq","eh","gl","tg","tv","sb","lr","ao","bq","ga","bt","py","sd","st","gw","um","jm","gf","om","mv","ge","ht","sz"];
        foreach ($_isos as $iso){
            $country = Country::whereIso(strtoupper($iso))
                ->firstOrFail();

            if(File::exists("database/json/provinces/".$iso.".json")){
                $jsonProvinces = File::get("database/json/provinces/".$iso.".json");
                $provinces = json_decode($jsonProvinces);
                $states_codes = [];
                foreach ($provinces as $province) {
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
        $_isos = ["fr","li","be","ci","tf","nl","dz","gp","lv","mu","tn","td","at","md","mh","er","kw","sm","kp","pl","se","tl","sk","kz","mx","tz","my","dk","si","ee","th","ad","sj","ru","tr","rs","cf","sg","nz","so","iq","sl","ca","bz","sh","bs","pe","vi","it","vu","km","lb","lt","rw","fj","cn","ro","ph","mq","mw","nc","uy","gt","bm","na","hu","do","ae","bw","pm","gm","bb","dm","gr","re","by","lk","gb","ua","sc","la","mm","mc","fm","zm","bg","ke","ie","ve","id","pt","kg","jp","vn","nr","lu","ly","co","al","gd","mg","im","ba","vc","br","va","kh","ki","cd","az","eg","kr","dj","ch","sy","il","is","sn","cz","cl","pa","za","ir","mp","de","tj","je","ax","ug","ws","cu","ec","au","sr","cr","mk","gh","pk","pg","ye","in","bh","cv","np","tm","mn","mr","us","no","ag","ni","bd","pr","jo","cy","fi","ls","et","ma","zw","sv","sa","bo","bf","qa","hr","ky","as","kn","yt","ng","gu","uz","af","cg","ml","cm","am","me","ar","gn","fo","es","pw","gg","gy","bn","hn","ne","tt","tw","wf","to","bj","aq","mt","mz","bi","gq","eh","gl","tg","tv","sb","lr","ao","bq","ga","bt","py","sd","st","gw","um","jm","gf","om","mv","ge","ht","sz"];
        foreach ($_isos as $iso){
            $country = Country::whereIso(strtoupper($iso))
                ->firstOrFail();

            if(File::exists("database/json/cities/".$iso.".json")){
                $jsonCities = File::get("database/json/cities/".$iso.".json");
                $cities = json_decode($jsonCities);
                $states_codes = [];
                $provinces_codes = [];
                foreach ($cities as $city) {
                    $stateId = null;
                    $provinceId = null;
                    if($city->province_code!=''){
                        if(!array_key_exists($city->province_code, $provinces_codes)){
                            $province = Province::where([
                                'csg_country_id'=>$country->id,
                                'code'=>$city->province_code
                            ])->firstOrFail();
                            $provinceId = $province->id;
                            $provinces_codes[$city->province_code] = $provinceId;
                        }else{
                            $provinceId = $provinces_codes[$city->province_code];
                        }
                    }
                    if($city->state_code!=''){
                        if(!array_key_exists($city->state_code, $states_codes)){
                            $state = State::where([
                                'csg_country_id'=>$country->id,
                                'code'=>$city->state_code
                            ])->firstOrFail();
                            $stateId = $state->id;
                            $states_codes[$city->state_code] = $stateId;
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
