<?php

namespace Cherryant\CountryStateGeo\Database\Seeders\Languages;

use Illuminate\Database\Seeder;
use Cherryant\CountryStateGeo\Database\Seeders\Builder;

class RussianLanguageSeeder extends Seeder
{

    /**
     * Attribute that defines the language of countries
     *
     * @var string
     */
    protected $lang = 'ru';

    /**
     * Attribute that defines regions
     *
     * @var array
     */
    protected $regions = [
        'africa' => 'Африка',
        'americas' => 'Америки',
        'asia' => 'Азия',
        'europe' => 'Европа',
        'oceania' => 'Океания',
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Builder::regionsTranslations($this->regions, $this->lang);
        Builder::countriesTranslations($this->countries(), $this->lang);
    }

    public function countries()
    {
        return [
            'AI' => 'Ангилья',
            'AG' => 'Антигуа и Барбуда',
            'AR' => 'Аргентина',
            'AW' => 'Аруба',
            'BS' => 'Багамы',
            'BB' => 'Барбадос',
            'BZ' => 'Белиз',
            'BM' => 'Бермуды',
            'BO' => 'Боливия',
            'BR' => 'Бразилия',
            'CA' => 'Канада',
            'CL' => 'Чили',
            'CO' => 'Колумбия',
            'CR' => 'Коста-Рика',
            'CU' => 'Куба',
            'DM' => 'Доминика',
            'SV' => 'Сальвадор',
            'EC' => 'Эквадор',
            'US' => 'Соединенные Штаты Америки',
            'GD' => 'Гренада',
            'GL' => 'Гренландия',
            'GP' => 'Гваделупа',
            'GT' => 'Гватемала',
            'GY' => 'Гайана',
            'GF' => 'Французская Гвиана',
            'HT' => 'Гаити',
            'HN' => 'Гондурас',
            'KY' => 'Каймановы острова',
            'FK' => 'Фолклендские острова',
            'TC' => 'Теркс и Кайкос',
            'VG' => 'Британские Виргинские острова',
            'VI' => 'Американские Виргинские острова',
            'JM' => 'Ямайка',
            'MQ' => 'Мартиника',
            'MS' => 'Монтсеррат',
            'MX' => 'Мексика',
            'NI' => 'Никарагуа',
            'PA' => 'Панама',
            'PY' => 'Парагвай',
            'PE' => 'Перу',
            'PR' => 'Пуэрто-Рико',
            'DO' => 'Доминиканская Республика',
            'PM' => 'Сен-Пьер и Микелон',
            'LC' => 'Сент-Люсия',
            'SR' => 'Суринам',
            'BL' => 'Сен-Бартелеми',
            'KN' => 'Сент-Китс и Невис',
            'MF' => 'Сен-Мартен',
            'VC' => 'Сент-Винсент и Гренадины',
            'TT' => 'Тринидад и Тобаго',
            'UY' => 'Уругвай',
            'VE' => 'Венесуэла',
            'AL' => 'Албания',
            'DE' => 'Германия',
            'AD' => 'Андорра',
            'BY' => 'Беларусь',
            'BG' => 'Болгария',
            'BE' => 'Бельгия',
            'BA' => 'Босния и Герцеговина',
            'CY' => 'Кипр',
            'HR' => 'Хорватия',
            'DK' => 'Дания',
            'SK' => 'Словакия',
            'SI' => 'Словения',
            'ES' => 'Испания',
            'EE' => 'Эстония',
            'FI' => 'Финляндия',
            'FR' => 'Франция',
            'GI' => 'Гибралтар',
            'GR' => 'Греция',
            'GG' => 'Гернси',
            'NL' => 'Нидерланды',
            'HU' => 'Венгрия',
            'IM' => 'Остров Мэн',
            'AX' => 'Аландские острова',
            'FO' => 'Фарерские острова',
            'IE' => 'Ирландия',
            'IS' => 'Исландия',
            'IT' => 'Италия',
            'JE' => 'Джерси',
            'LV' => 'Латвия',
            'LI' => 'Лихтенштейн',
            'LT' => 'Литва',
            'LU' => 'Люксембург',
            'MK' => 'Македония',
            'MT' => 'Мальта',
            'MD' => 'Молдова',
            'ME' => 'Черногория',
            'MC' => 'Монако',
            'NO' => 'Норвегия',
            'PL' => 'Польша',
            'PT' => 'Португалия',
            'GB' => 'Великобритания',
            'CZ' => 'Чехия',
            'RO' => 'Румыния',
            'RU' => 'Россия',
            'SM' => 'Сан-Марино',
            'SE' => 'Швеция',
            'CH' => 'Швейцария',
            'SJ' => 'Шпицберген и Ян-Майен',
            'RS' => 'Сербия',
            'CS' => 'Сербия и Черногория',
            'UA' => 'Украина',
            'VA' => 'Ватикан',
            'AT' => 'Австрия',
            'AQ' => 'Антарктида',
            'AU' => 'Австралия',
            'FJ' => 'Фиджи',
            'GS' => 'Южная Георгия и Южные Сандвичевы острова',
            'GU' => 'Гуам',
            'BV' => 'Остров Буве',
            'HM' => 'Херд и Макдональд, острова',
            'NF' => 'Остров Норфолк',
            'CC' => 'Кокосовые острова',
            'CK' => 'Острова Кука',
            'MP' => 'Северные Марианские острова',
            'MH' => 'Маршалловы острова',
            'UM' => 'Внешние малые острова (США)',
            'CX' => 'Остров Рождества',
            'SB' => 'Соломоновы острова',
            'FM' => 'Микронезия',
            'NR' => 'Науру',
            'NU' => 'Ниуэ',
            'NC' => 'Новая Каледония',
            'NZ' => 'Новая Зеландия',
            'PW' => 'Палау',
            'PG' => 'Папуа-Новая Гвинея',
            'PN' => 'Питкэрн',
            'PF' => 'Французская Полинезия',
            'KI' => 'Кирибати',
            'WS' => 'Самоа',
            'AS' => 'Американское Самоа',
            'IO' => 'Британская территория в Индийском океане',
            'TF' => 'Французские Южные и Антарктические территории',
            'TK' => 'Токелау',
            'TO' => 'Тонга',
            'TV' => 'Тувалу',
            'VU' => 'Вануату',
            'WF' => 'Уоллис и Футуна',
            'AO' => 'Ангола',
            'DZ' => 'Алжир',
            'BJ' => 'Бенин',
            'BW' => 'Ботсвана',
            'BF' => 'Буркина-Фасо',
            'BI' => 'Бурунди',
            'CV' => 'Кабо-Верде',
            'TD' => 'Чад',
            'KM' => 'Коморы',
            'CG' => 'Конго',
            'CD' => 'Демократическая Республика Конго',
            'CI' => 'Кот-д\'Ивуар',
            'DJ' => 'Джибути',
            'EG' => 'Египет',
            'ER' => 'Эритрея',
            'ET' => 'Эфиопия',
            'GA' => 'Габон',
            'GH' => 'Гана',
            'GN' => 'Гвинея',
            'GW' => 'Гвинея-Бисау',
            'GQ' => 'Экваториальная Гвинея',
            'GM' => 'Гамбия',
            'LS' => 'Лесото',
            'LR' => 'Либерия',
            'LY' => 'Ливия',
            'MG' => 'Мадагаскар',
            'MW' => 'Малави',
            'ML' => 'Мали',
            'MA' => 'Марокко',
            'MR' => 'Мавритания',
            'MU' => 'Маврикий',
            'YT' => 'Майотта',
            'MZ' => 'Мозамбик',
            'NA' => 'Намибия',
            'NG' => 'Нигерия',
            'NE' => 'Нигер',
            'KE' => 'Кения',
            'CF' => 'Центральноафриканская Республика',
            'CM' => 'Камерун',
            'RE' => 'Реюньон',
            'RW' => 'Руанда',
            'EH' => 'Западная Сахара',
            'SH' => 'Остров Святой Елены',
            'SN' => 'Сенегал',
            'SL' => 'Сьерра-Леоне',
            'SC' => 'Сейшельские Острова',
            'SO' => 'Сомали',
            'SZ' => 'Свазиленд',
            'SD' => 'Судан',
            'ST' => 'Сан-Томе и Принсипи',
            'TZ' => 'Танзания',
            'TG' => 'Того',
            'TN' => 'Тунис',
            'UG' => 'Уганда',
            'ZW' => 'Зимбабве',
            'ZM' => 'Замбия',
            'ZA' => 'Южно-Африканская Республика',
            'AF' => 'Афганистан',
            'AM' => 'Армения',
            'SA' => 'Саудовская Аравия',
            'AZ' => 'Азербайджан',
            'BH' => 'Бахрейн',
            'BD' => 'Бангладеш',
            'BN' => 'Бруней',
            'BT' => 'Бутан',
            'KH' => 'Камбоджа',
            'KZ' => 'Казахстан',
            'QA' => 'Катар',
            'CN' => 'Китай',
            'SG' => 'Сингапур',
            'KP' => 'Северная Корея',
            'KR' => 'Южная Корея',
            'AE' => 'Объединенные Арабские Эмираты',
            'PH' => 'Филиппины',
            'GE' => 'Грузия',
            'HK' => 'Гонконг, Особый административный район Китая',
            'ID' => 'Индонезия',
            'IQ' => 'Ирак',
            'IR' => 'Иран',
            'IL' => 'Израиль',
            'YE' => 'Йемен',
            'JP' => 'Япония',
            'JO' => 'Иордания',
            'KW' => 'Кувейт',
            'LB' => 'Ливан',
            'MO' => 'Макао, Особый административный район Китая',
            'MV' => 'Мальдивы',
            'MY' => 'Малайзия',
            'MM' => 'Мьянма',
            'MN' => 'Монголия',
            'NP' => 'Непал',
            'OM' => 'Оман',
            'PK' => 'Пакистан',
            'KG' => 'Киргизия',
            'LA' => 'Лаосская Народно-Демократическая Республика',
            'LK' => 'Шри-Ланка',
            'SY' => 'Сирия',
            'TJ' => 'Таджикистан',
            'TH' => 'Таиланд',
            'TW' => 'Тайвань',
            'PS' => 'Территория Палестины',
            'TL' => 'Тимор-Лесте',
            'TM' => 'Туркменистан',
            'TR' => 'Турция',
            'UZ' => 'Узбекистан',
            'VN' => 'Вьетнам',
            'IN' => 'Индия',
        ];
    }
}
