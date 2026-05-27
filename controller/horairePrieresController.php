<?php

class HorairePrieresController
{
    public function index()
    {

        // =========================================
        // SESSION
        // =========================================

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // =========================================
        // ERREURS
        // =========================================

        ini_set('display_errors', 1);

        error_reporting(E_ALL);

        // =========================================
        // VARIABLES
        // =========================================

        $ville =
            $_GET['ville']
            ?? 'Dakar';

        $pays =
            $_GET['pays']
            ?? 'Senegal';

        $latitude =
            $_GET['latitude']
            ?? null;

        $longitude =
            $_GET['longitude']
            ?? null;

        // =========================================
        // API URL
        // =========================================

        if ($latitude && $longitude) {

            $apiUrl =
                "https://api.aladhan.com/v1/timings?"
                . "latitude="
                . urlencode($latitude)
                . "&longitude="
                . urlencode($longitude)
                . "&method=2";

        } else {

            $apiUrl =
                "https://api.aladhan.com/v1/timingsByCity?"
                . "city="
                . urlencode($ville)
                . "&country="
                . urlencode($pays)
                . "&method=2";

        }

        // =========================================
        // API
        // =========================================

        $response =
            @file_get_contents($apiUrl);

        // =========================================
        // JSON
        // =========================================

        $apiData = [];

        if ($response) {

            $apiData =
                json_decode($response, true);

        }

        // =========================================
        // VARIABLES VUE
        // =========================================

        $timings = [];

        $dateGreg = '';

        $dateHijri = '';

        $timezone = 'Africa/Dakar';

        // =========================================
        // DONNEES
        // =========================================

        if (
            isset($apiData['data'])
            &&
            isset($apiData['data']['timings'])
        ) {

            $timings =
                $apiData['data']['timings'];

            $dateGreg =
                $apiData['data']['date']['readable'];

            $dateHijri =
                $apiData['data']['date']['hijri']['date'];

            if (
                isset(
                    $apiData['data']['meta']['timezone']
                )
            ) {

                $timezone =
                    $apiData['data']['meta']['timezone'];

            }

        }

        // =========================================
        // TIMEZONE DYNAMIQUE
        // =========================================

        date_default_timezone_set($timezone);

        // =========================================
        // HEURE ACTUELLE
        // =========================================

        $now =
            date('H:i');

        // =========================================
        // PRIERES
        // =========================================

        $prieres = [
            'Fajr',
            'Dhuhr',
            'Asr',
            'Maghrib',
            'Isha'
        ];

        // =========================================
        // PRIERE ACTIVE
        // =========================================

        $priereActive = 'Fajr';

        foreach ($prieres as $priere) {

            if (!isset($timings[$priere])) {
                continue;
            }

            if ($now < $timings[$priere]) {
                $priereActive = $priere;
                break;
            }

        }

        // =========================================
        // APRES ISHA
        // =========================================

        if ($now > ($timings['Isha'] ?? '23:59')) {
            $priereActive = 'Fajr';
        }

        // =========================================
        // SECURITE
        // =========================================

        if (empty($timings)) {

            $timings = [
                'Fajr'    => '--:--',
                'Dhuhr'   => '--:--',
                'Asr'     => '--:--',
                'Maghrib' => '--:--',
                'Isha'    => '--:--',
                'Sunrise' => '--:--',
                'Sunset'  => '--:--'
            ];

        }

        // =========================================
        // TRADUCTIONS
        // =========================================

        $lang = $_SESSION['lang'] ?? 'fr';

        $textes = [

            'fr' => [
                'titre'      => 'Horaires de Prières',
                'sous_titre' => 'Consultez les horaires quotidiens',
                'ville'      => 'Ville',
                'pays'       => 'Pays',
                'rechercher' => 'Rechercher',
                'souba'      => 'Souba (Lever)',
                'coucher'    => 'Coucher',
                'prochaine'  => 'Prochaine',
                'dates'      => '📅 Dates Importantes',
                'activer'    => '🔊 Activer l\'Adhan',
                'desactiver' => '🔇 Désactiver l\'Adhan',
                'dir'        => 'ltr',
            ],

            'wo' => [
                'titre'      => 'Waktu Salaate yi',
                'sous_titre' => 'Xool waktu salaate bu tey',
                'ville'      => 'Dëkk',
                'pays'       => 'Réewum',
                'rechercher' => 'Seet',
                'souba'      => 'Souba',
                'coucher'    => 'Timis',
                'prochaine'  => 'Ci kanam',
                'dates'      => '📅 Bés yu mel si',
                'activer'    => '🔊 Jëfandikoo Adhan',
                'desactiver' => '🔇 Tëj Adhan',
                'dir'        => 'ltr',
            ],

            'ar' => [
                'titre'      => 'مواقيت الصلاة',
                'sous_titre' => 'تحقق من مواقيت الصلاة اليومية',
                'ville'      => 'المدينة',
                'pays'       => 'البلد',
                'rechercher' => 'بحث',
                'souba'      => 'شروق الشمس',
                'coucher'    => 'غروب الشمس',
                'prochaine'  => 'القادمة',
                'dates'      => '📅 المناسبات الإسلامية',
                'activer'    => '🔊 تفعيل الأذان',
                'desactiver' => '🔇 إيقاف الأذان',
                'dir'        => 'rtl',
            ],

            'en' => [
                'titre'      => 'Prayer Times',
                'sous_titre' => 'Check daily prayer times',
                'ville'      => 'City',
                'pays'       => 'Country',
                'rechercher' => 'Search',
                'souba'      => 'Sunrise',
                'coucher'    => 'Sunset',
                'prochaine'  => 'Next',
                'dates'      => '📅 Important Islamic Dates',
                'activer'    => '🔊 Enable Adhan',
                'desactiver' => '🔇 Disable Adhan',
                'dir'        => 'ltr',
            ],

        ];

        $t = $textes[$lang] ?? $textes['fr'];

        // =========================================
        // VUE
        // =========================================

        require_once __DIR__
            . '/../view/pages/admin/horairesprieres/listeHeuresprieres.php';

    }
}