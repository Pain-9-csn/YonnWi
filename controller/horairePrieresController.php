<?php

class HorairePrieresController
{
    public function index(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $lang = $_SESSION['lang'] ?? 'fr';

        $ville     = trim($_GET['ville'] ?? 'Dakar');
        $pays      = trim($_GET['pays']  ?? 'Senegal');
        $latitude  = isset($_GET['latitude'])  ? (float) $_GET['latitude']  : null;
        $longitude = isset($_GET['longitude']) ? (float) $_GET['longitude'] : null;

        // =====================
        // APPEL API ALADHAN
        // =====================

        if ($latitude && $longitude) {
            $apiUrl = sprintf(
                "https://api.aladhan.com/v1/timings?latitude=%s&longitude=%s&method=2",
                urlencode($latitude),
                urlencode($longitude)
            );
        } else {
            $apiUrl = sprintf(
                "https://api.aladhan.com/v1/timingsByCity?city=%s&country=%s&method=2",
                urlencode($ville),
                urlencode($pays)
            );
        }

        $ctx = stream_context_create(['http' => ['timeout' => 8, 'ignore_errors' => true]]);
        $response = @file_get_contents($apiUrl, false, $ctx);
        $apiData  = $response ? json_decode($response, true) : [];

        // =====================
        // EXTRACTION DES DONNÉES
        // =====================

        $timings   = [];
        $dateGreg  = '';
        $dateHijri = '';
        $timezone  = 'Africa/Dakar';

        if (!empty($apiData['data']['timings'])) {

            $timings   = $apiData['data']['timings'];
            $dateHijri = $apiData['data']['date']['hijri']['date'] ?? '';
            $timezone  = $apiData['data']['meta']['timezone'] ?? 'Africa/Dakar';
            $dateRaw   = $apiData['data']['date']['gregorian']['date'] ?? date('d-m-Y');

            $dateObj = DateTime::createFromFormat('d-m-Y', $dateRaw);

            $months = $this->getMonths();

            if ($dateObj) {
                $formatted = $dateObj->format('d F Y');
                $map       = $months[$lang] ?? $months['fr'];
                $dateGreg  = str_replace(array_keys($map), array_values($map), $formatted);
            }
        }

        date_default_timezone_set($timezone);

        // Fallback si API indisponible
        if (empty($timings)) {
            $timings = array_fill_keys(
                ['Fajr','Sunrise','Dhuhr','Asr','Maghrib','Isha','Sunset'],
                '--:--'
            );
        }

        // =====================
        // PRIÈRE ACTIVE
        // =====================

        $now          = date('H:i');
        $prieres      = ['Fajr', 'Dhuhr', 'Asr', 'Maghrib', 'Isha'];
        $priereActive = 'Isha'; // défaut

        foreach ($prieres as $priere) {
            if (!empty($timings[$priere]) && $timings[$priere] !== '--:--' && $now < $timings[$priere]) {
                $priereActive = $priere;
                break;
            }
        }

        // =====================
        // TRADUCTIONS
        // =====================

        $traduction = $this->getTextes($lang);

        require_once __DIR__ . '/../view/pages/vitrine/horairesprieres/listeHeuresprieres.php';
    }

    // =====================
    // MOIS TRADUITS
    // =====================

    private function getMonths(): array
    {
        return [
            'fr' => [
                'January'=>'Janvier','February'=>'Février','March'=>'Mars',
                'April'=>'Avril','May'=>'Mai','June'=>'Juin','July'=>'Juillet',
                'August'=>'Août','September'=>'Septembre','October'=>'Octobre',
                'November'=>'Novembre','December'=>'Décembre',
            ],
            'en' => [
                'January'=>'January','February'=>'February','March'=>'March',
                'April'=>'April','May'=>'May','June'=>'June','July'=>'July',
                'August'=>'August','September'=>'September','October'=>'October',
                'November'=>'November','December'=>'December',
            ],
            'ar' => [
                'January'=>'يناير','February'=>'فبراير','March'=>'مارس',
                'April'=>'أبريل','May'=>'مايو','June'=>'يونيو','July'=>'يوليو',
                'August'=>'أغسطس','September'=>'سبتمبر','October'=>'أكتوبر',
                'November'=>'نوفمبر','December'=>'ديسمبر',
            ],
            'wo' => [
                'January'=>'Samwiye','February'=>'Fewriye','March'=>'Mars',
                'April'=>'Awril','May'=>'Mee','June'=>'Suwe','July'=>'Sulet',
                'August'=>'Ut','September'=>'Sàttumbar','October'=>'Oktoobar',
                'November'=>'Nowàmbar','December'=>'Desàmbar',
            ],
        ];
    }

    // =====================
    // TEXTES UI MULTILINGUES
    // =====================

    private function getTextes(string $lang): array
    {
        $textes = [
            'fr' => [
                'titre'       => 'Horaires de Prières',
                'sous_titre'  => 'Consultez les horaires quotidiens',
                'ville'       => 'Ville',
                'pays'        => 'Pays',
                'rechercher'  => 'Rechercher',
                'souba'       => 'Souba (Lever)',
                'coucher'     => 'Coucher',
                'prochaine'   => 'Prochaine',
                'dates'       => '📅 Dates Importantes',
                'activer'     => '🔊 Activer l\'Adhan',
                'desactiver'  => '🔇 Désactiver l\'Adhan',
                'dir'         => 'ltr',
                'dans'        => 'dans',
                'prieres'     => ['Fajr'=>'Fadjr','Dhuhr'=>'Dohr','Asr'=>'Asr','Maghrib'=>'Maghrib','Isha'=>'Icha'],
            ],
            'en' => [
                'titre'       => 'Prayer Times',
                'sous_titre'  => 'Check daily prayer times',
                'ville'       => 'City',
                'pays'        => 'Country',
                'rechercher'  => 'Search',
                'souba'       => 'Sunrise',
                'coucher'     => 'Sunset',
                'prochaine'   => 'Next',
                'dates'       => '📅 Important Dates',
                'activer'     => '🔊 Enable Adhan',
                'desactiver'  => '🔇 Disable Adhan',
                'dir'         => 'ltr',
                'dans'        => 'in',
                'prieres'     => ['Fajr'=>'Fajr','Dhuhr'=>'Dhuhr','Asr'=>'Asr','Maghrib'=>'Maghrib','Isha'=>'Isha'],
            ],
            'ar' => [
                'titre'       => 'مواقيت الصلاة',
                'sous_titre'  => 'تحقق من المواقيت اليومية',
                'ville'       => 'المدينة',
                'pays'        => 'البلد',
                'rechercher'  => 'بحث',
                'souba'       => 'الشروق',
                'coucher'     => 'الغروب',
                'prochaine'   => 'القادمة',
                'dates'       => '📅 المناسبات',
                'activer'     => '🔊 تشغيل الأذان',
                'desactiver'  => '🔇 إيقاف الأذان',
                'dir'         => 'rtl',
                'dans'        => 'في',
                'prieres'     => ['Fajr'=>'الفجر','Dhuhr'=>'الظهر','Asr'=>'العصر','Maghrib'=>'المغرب','Isha'=>'العشاء'],
            ],
            'wo' => [
                'titre'       => 'Waktu Salaate yi',
                'sous_titre'  => 'Xool waktu salaate bu tey',
                'ville'       => 'Dëkk',
                'pays'        => 'Réew',
                'rechercher'  => 'Seet',
                'souba'       => 'Souba',
                'coucher'     => 'Timis',
                'prochaine'   => 'Ci kanam',
                'dates'       => '📅 Bés yu mel si',
                'activer'     => '🔊 Jëfandikoo Nodou',
                'desactiver'  => '🔇 Tëj Nodou',
                'dir'         => 'ltr',
                'dans'        => 'ci',
                'prieres'     => ['Fajr'=>'Fadjr','Dhuhr'=>'Tisbar','Asr'=>'Takussan','Maghrib'=>'Timis','Isha'=>'Gué'],
            ],
        ];

        return $textes[$lang] ?? $textes['fr'];
    }
}