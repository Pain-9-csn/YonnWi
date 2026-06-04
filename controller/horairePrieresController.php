<?php

class HorairePrieresController
{
    public function index()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        ini_set('display_errors', 1);
        error_reporting(E_ALL);

        $lang = $_SESSION['lang'] ?? 'fr';

        $ville     = $_GET['ville'] ?? 'Dakar';
        $pays      = $_GET['pays'] ?? 'Senegal';
        $latitude  = $_GET['latitude'] ?? null;
        $longitude = $_GET['longitude'] ?? null;

        // =====================
        // API
        // =====================

        if ($latitude && $longitude) {

            $apiUrl =
                "https://api.aladhan.com/v1/timings?"
                ."latitude=".urlencode($latitude)
                ."&longitude=".urlencode($longitude)
                ."&method=2";

        } else {

            $apiUrl =
                "https://api.aladhan.com/v1/timingsByCity?"
                ."city=".urlencode($ville)
                ."&country=".urlencode($pays)
                ."&method=2";
        }

        $response =
            @file_get_contents($apiUrl);

        $apiData = [];

        if ($response) {
            $apiData =
                json_decode($response,true);
        }

        $timings   = [];
        $dateGreg  = '';
        $dateHijri = '';
        $timezone  = 'Africa/Dakar';

        // =====================
        // DATA API
        // =====================

        if (
            isset($apiData['data']) &&
            isset($apiData['data']['timings'])
        ) {

            $timings =
                $apiData['data']['timings'];

            $dateHijri =
                $apiData['data']['date']['hijri']['date'];

            $timezone =
                $apiData['data']['meta']['timezone']
                ?? 'Africa/Dakar';

            $dateAPI =
                $apiData['data']['date']['gregorian']['date']
                ?? date('d-m-Y');

            $dateObj =
                DateTime::createFromFormat(
                    'd-m-Y',
                    $dateAPI
                );

            $months = [

                'fr'=>[
                    'January'=>'Janvier',
                    'February'=>'Février',
                    'March'=>'Mars',
                    'April'=>'Avril',
                    'May'=>'Mai',
                    'June'=>'Juin',
                    'July'=>'Juillet',
                    'August'=>'Août',
                    'September'=>'Septembre',
                    'October'=>'Octobre',
                    'November'=>'Novembre',
                    'December'=>'Décembre'
                ],

                'en'=>[
                    'January'=>'January',
                    'February'=>'February',
                    'March'=>'March',
                    'April'=>'April',
                    'May'=>'May',
                    'June'=>'June',
                    'July'=>'July',
                    'August'=>'August',
                    'September'=>'September',
                    'October'=>'October',
                    'November'=>'November',
                    'December'=>'December'
                ],

                'ar'=>[
                    'January'=>'يناير',
                    'February'=>'فبراير',
                    'March'=>'مارس',
                    'April'=>'أبريل',
                    'May'=>'مايو',
                    'June'=>'يونيو',
                    'July'=>'يوليو',
                    'August'=>'أغسطس',
                    'September'=>'سبتمبر',
                    'October'=>'أكتوبر',
                    'November'=>'نوفمبر',
                    'December'=>'ديسمبر'
                ],

                'wo'=>[
                    'January'=>'Samwiye',
                    'February'=>'Fewriye',
                    'March'=>'Mars',
                    'April'=>'Awril',
                    'May'=>'Mee',
                    'June'=>'Suwe',
                    'July'=>'Sulet',
                    'August'=>'Ut',
                    'September'=>'Sàttumbar',
                    'October'=>'Oktoobar',
                    'November'=>'Nowàmbar',
                    'December'=>'Desàmbar'
                ]

            ];

            if ($dateObj) {

                $formatted =
                    $dateObj->format('d F Y');

                $dateGreg =
                    str_replace(

                        array_keys(
                            $months[$lang]
                            ?? $months['fr']
                        ),

                        array_values(
                            $months[$lang]
                            ?? $months['fr']
                        ),

                        $formatted
                    );
            }
        }

        date_default_timezone_set($timezone);

        // =====================
        // PRIERE ACTIVE
        // =====================

        $now = date('H:i');

        $prieres = [

            'Fajr',
            'Dhuhr',
            'Asr',
            'Maghrib',
            'Isha'

        ];

        $priereActive = 'Fajr';

        foreach ($prieres as $priere) {

            if (!isset($timings[$priere])) {
                continue;
            }

            if ($now < $timings[$priere]) {

                $priereActive =
                    $priere;

                break;
            }
        }

        if ($now > ($timings['Isha'] ?? '23:59')) {
            $priereActive = 'Fajr';
        }

        if (empty($timings)) {

            $timings = [

                'Fajr'=>'--:--',
                'Dhuhr'=>'--:--',
                'Asr'=>'--:--',
                'Maghrib'=>'--:--',
                'Isha'=>'--:--',
                'Sunrise'=>'--:--',
                'Sunset'=>'--:--'

            ];
        }

        // =====================
        // TRADUCTIONS
        // =====================

        $textes = [

        'fr'=>[

        'titre'=>'Horaires de Prières',
        'sous_titre'=>'Consultez les horaires quotidiens',
        'ville'=>'Ville',
        'pays'=>'Pays',
        'rechercher'=>'Rechercher',
        'souba'=>'Souba (Lever)',
        'coucher'=>'Coucher',
        'prochaine'=>'Prochaine',
        'dates'=>'📅 Dates Importantes',
        'activer'=>'🔊 Activer l\'Adhan',
        'desactiver'=>'🔇 Désactiver l\'Adhan',
        'dir'=>'ltr',
        'dans' => 'dans',

        'prieres'=>[
        'Fajr'=>'Fadjr',
        'Dhuhr'=>'Dohr',
        'Asr'=>'Asr',
        'Maghrib'=>'Maghrib',
        'Isha'=>'Icha'
        ]

        ],

        'en'=>[

        'titre'=>'Prayer Times',
        'sous_titre'=>'Check daily prayer times',
        'ville'=>'City',
        'pays'=>'Country',
        'rechercher'=>'Search',
        'souba'=>'Sunrise',
        'coucher'=>'Sunset',
        'prochaine'=>'Next',
        'dates'=>'📅 Important Dates',
        'activer'=>'🔊 Enable Adhan',
        'desactiver'=>'🔇 Disable Adhan',
        'dir'=>'ltr',
        'dans' => 'in',

        'prieres'=>[
        'Fajr'=>'Fajr',
        'Dhuhr'=>'Dhuhr',
        'Asr'=>'Asr',
        'Maghrib'=>'Maghrib',
        'Isha'=>'Isha'
        ]

        ],

        'ar'=>[

        'titre'=>'مواقيت الصلاة',
        'sous_titre'=>'تحقق من المواقيت اليومية',
        'ville'=>'المدينة',
        'pays'=>'البلد',
        'rechercher'=>'بحث',
        'souba'=>'الشروق',
        'coucher'=>'الغروب',
        'prochaine'=>'القادمة',
        'dates'=>'📅 المناسبات',
        'activer'=>'🔊 تشغيل الأذان',
        'desactiver'=>'🔇 إيقاف الأذان',
        'dir'=>'rtl',
        'dans' => 'في',

        'prieres'=>[
        'Fajr'=>'الفجر',
        'Dhuhr'=>'الظهر',
        'Asr'=>'العصر',
        'Maghrib'=>'المغرب',
        'Isha'=>'العشاء'
        ]

        ],

        'wo'=>[

        'titre'=>'Waktu Salaate yi',
        'sous_titre'=>'Xool waktu salaate bu tey',
        'ville'=>'Dëkk',
        'pays'=>'Réew',
        'rechercher'=>'Seet',
        'souba'=>'Souba',
        'coucher'=>'Timis',
        'prochaine'=>'Ci kanam',
        'dates'=>'📅 Bés yu mel si',
        'activer'=>'🔊 Jëfandikoo Adhan',
        'desactiver'=>'🔇 Tëj Adhan',
        'dir'=>'ltr',
        'dans' => 'ci ',

        'prieres'=>[
        'Fajr'=>'Fadjr',
        'Dhuhr'=>'Tisbar',
        'Asr'=>'Takussan',
        'Maghrib'=>'Timis',
        'Isha'=>'Gué'
        ]

        ]

        ];

        $traduction = 
            $textes[$lang]
            ?? $textes['fr'];

            

        require_once __DIR__
        . '/../view/pages/vitrine/horairesprieres/listeHeuresprieres.php';
    }
}