<?php

require_once __DIR__ . '/../model/qiblaDB.php';

class QiblaController
{
    private QiblaDB $model;

    public function __construct()
    {
        $this->model = new QiblaDB();
    }

    // =========================================
    // PAGE PRINCIPALE QIBLA
    // =========================================

    public function index(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $lang = $_SESSION['lang'] ?? 'fr';

        // Traductions UI
        $textes = $this->getTextes($lang);

        // Coordonnées de la Mecque (fixes)
        $meccaLat = 21.4225;
        $meccaLng = 39.8262;

        // Sauvegarde optionnelle en DB si l'utilisateur est connecté
        $userId = $_SESSION['user_id'] ?? null;

        require_once __DIR__ . '/../view/pages/vitrine/qibla/qibla.php';
    }

    // =========================================
    // AJAX — enregistrer localisation (POST)
    // =========================================

    public function enregistrerLocalisation(): void
    {
        header('Content-Type: application/json; charset=utf-8');

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $lat    = isset($_POST['lat'])  ? (float) $_POST['lat']  : null;
        $lng    = isset($_POST['lng'])  ? (float) $_POST['lng']  : null;
        $userId = $_SESSION['user_id'] ?? null;

        if ($lat === null || $lng === null) {
            echo json_encode(['success' => false, 'erreur' => 'Coordonnées manquantes']);
            return;
        }

        // Calcul de la direction Qibla côté serveur (degrés)
        $direction = $this->model->calculerQibla($lat, $lng);

        // Sauvegarde si connecté
        if ($userId) {
            $this->model->sauvegarderLocalisation($userId, $lat, $lng, $direction);
        }

        echo json_encode([
            'success'   => true,
            'direction' => round($direction, 2),
            'lat'       => $lat,
            'lng'       => $lng,
        ]);
    }

    // =========================================
    // TEXTES UI MULTILINGUES
    // =========================================

    private function getTextes(string $lang): array
    {
        $textes = [
            'fr' => [
                'titre'       => 'Direction de la Qibla',
                'sous_titre'  => 'Trouvez la direction de La Mecque depuis votre position',
                'localiser'   => 'Me localiser',
                'en_cours'    => 'Localisation en cours…',
                'mecque'      => 'La Mecque',
                'distance'    => 'Distance',
                'direction'   => 'Direction',
                'nord'        => 'N',
                'erreur_geo'  => 'Géolocalisation non disponible sur votre appareil.',
                'refus_geo'   => 'Vous avez refusé la géolocalisation.',
                'bismillah'   => 'وَلِلَّهِ الْمَشْرِقُ وَالْمَغْرِبُ ۚ فَأَيْنَمَا تُوَلُّوا فَثَمَّ وَجْهُ اللَّهِ',
                'verset_ref'  => 'Sourate Al-Baqara, verset 115',
                'boussole'    => 'Boussole Qibla',
                'degres'      => '°',
                'km'          => 'km',
                'dir'         => 'ltr',
            ],
            'ar' => [
                'titre'       => 'اتجاه القبلة',
                'sous_titre'  => 'اعثر على اتجاه الكعبة المشرفة من موقعك',
                'localiser'   => 'تحديد موقعي',
                'en_cours'    => 'جار التحديد…',
                'mecque'      => 'مكة المكرمة',
                'distance'    => 'المسافة',
                'direction'   => 'الاتجاه',
                'nord'        => 'ش',
                'erreur_geo'  => 'تحديد الموقع غير متاح.',
                'refus_geo'   => 'تم رفض تحديد الموقع.',
                'bismillah'   => 'وَلِلَّهِ الْمَشْرِقُ وَالْمَغْرِبُ ۚ فَأَيْنَمَا تُوَلُّوا فَثَمَّ وَجْهُ اللَّهِ',
                'verset_ref'  => 'سورة البقرة، الآية ١١٥',
                'boussole'    => 'بوصلة القبلة',
                'degres'      => '°',
                'km'          => 'كم',
                'dir'         => 'rtl',
            ],
            'wo' => [
                'titre'       => 'Xëy Qibla bi',
                'sous_titre'  => 'Xool xëy Makka ak sa woon',
                'localiser'   => 'Seet ma',
                'en_cours'    => 'Seet yëgël…',
                'mecque'      => 'Makka',
                'distance'    => 'Kaw',
                'direction'   => 'Xëy',
                'nord'        => 'N',
                'erreur_geo'  => 'Géolocalisation dafa dox du leen.',
                'refus_geo'   => 'Dafa bañ géolocalisation bi.',
                'bismillah'   => 'وَلِلَّهِ الْمَشْرِقُ وَالْمَغْرِبُ ۚ فَأَيْنَمَا تُوَلُّوا فَثَمَّ وَجْهُ اللَّهِ',
                'verset_ref'  => 'Sourate Al-Baqara, verset 115',
                'boussole'    => 'Boussole Qibla',
                'degres'      => '°',
                'km'          => 'km',
                'dir'         => 'ltr',
            ],
            'en' => [
                'titre'       => 'Qibla Direction',
                'sous_titre'  => 'Find the direction of Mecca from your location',
                'localiser'   => 'Locate me',
                'en_cours'    => 'Locating…',
                'mecque'      => 'Mecca',
                'distance'    => 'Distance',
                'direction'   => 'Direction',
                'nord'        => 'N',
                'erreur_geo'  => 'Geolocation is not available on your device.',
                'refus_geo'   => 'You denied geolocation access.',
                'bismillah'   => 'وَلِلَّهِ الْمَشْرِقُ وَالْمَغْرِبُ ۚ فَأَيْنَمَا تُوَلُّوا فَثَمَّ وَجْهُ اللَّهِ',
                'verset_ref'  => 'Surah Al-Baqara, verse 115',
                'boussole'    => 'Qibla Compass',
                'degres'      => '°',
                'km'          => 'km',
                'dir'         => 'ltr',
            ],
        ];

        return $textes[$lang] ?? $textes['fr'];
    }
}