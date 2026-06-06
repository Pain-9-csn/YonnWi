<?php

require_once __DIR__ . '/../model/captureAudioDB.php';

class CaptureAudioController
{
    private CaptureAudioDB $model;

    public function __construct()
    {
        $this->model = new CaptureAudioDB();
    }

    // =========================================
    // PAGE PRINCIPALE — accès libre
    // =========================================

    public function index(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $lang     = $_SESSION['lang'] ?? 'fr';
        $xassidas = $this->model->getXassidasPopulaires(8);
        $textes   = $this->getTextes($lang);

        // Utilisateur connecté ? historique disponible
        $userId = $_SESSION['user_id'] ?? null;

        require_once __DIR__ . '/../view/pages/vitrine/dictaphone/voc.php';
    }

    // =========================================
    // AJAX — Identifier un xassida (accès libre)
    // =========================================

    public function identifier(): void
    {
        header('Content-Type: application/json; charset=utf-8');

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $fingerprint = trim($_POST['fingerprint'] ?? '');
        $duree       = isset($_POST['duree']) ? (int) $_POST['duree'] : 0;
        $userId      = $_SESSION['user_id'] ?? null; // null si non connecté

        if (empty($fingerprint)) {
            echo json_encode(['success' => false, 'erreur' => 'Aucun signal audio reçu.']);
            return;
        }

        $resultat = $this->model->rechercherParFingerprint($fingerprint);

        if ($resultat) {
            // Historique enregistré seulement si connecté
            if ($userId) {
                $this->model->sauvegarderCapture($userId, $resultat['id'], $duree, $fingerprint);
            }

            echo json_encode([
                'success' => true,
                'trouve'  => true,
                'xassida' => [
                    'id'          => $resultat['id'],
                    'titre'       => $resultat['titre'],
                    'auteur'      => $resultat['auteur']      ?? '',
                    'audio_url'   => $resultat['audio_url']   ?? '',
                    'image_url'   => $resultat['image_url']   ?? '',
                    'description' => $resultat['description'] ?? '',
                ],
            ]);
        } else {
            echo json_encode([
                'success' => true,
                'trouve'  => false,
                'message' => 'Xassida non reconnu. Essayez de fredonner un peu plus longtemps.',
            ]);
        }
    }

    // =========================================
    // AJAX — Xassidas populaires (accès libre)
    // =========================================

    public function ajaxXassidas(): void
    {
        header('Content-Type: application/json; charset=utf-8');

        $limite   = isset($_GET['limite']) ? (int) $_GET['limite'] : 12;
        $xassidas = $this->model->getXassidasPopulaires($limite);

        echo json_encode([
            'success'  => true,
            'xassidas' => $xassidas,
        ]);
    }

    // =========================================
    // TEXTES UI MULTILINGUES
    // =========================================

    private function getTextes(string $lang): array
    {
        $textes = [
            'fr' => [
                'titre'        => 'Reconnaissance Vocale',
                'sous_titre'   => 'Fredonnez ou chantez un extrait de Xassida pour l\'identifier',
                'btn_ecouter'  => 'Commencer l\'écoute',
                'btn_stop'     => 'Arrêter',
                'btn_relancer' => 'Réessayer',
                'ecoute'       => 'Écoute en cours…',
                'analyse'      => 'Analyse du signal…',
                'trouve'       => 'Xassida identifié !',
                'non_trouve'   => 'Non reconnu',
                'populaires'   => 'Xassidas populaires',
                'ecouter'      => 'Écouter',
                'conseil1'     => 'Fredonnez clairement pendant au moins 5 secondes',
                'conseil2'     => 'Réduisez les bruits de fond pour une meilleure détection',
                'conseil3'     => 'Tenez l\'appareil proche de la source sonore',
                'conseil4'     => 'Les récitations lentes sont mieux reconnues',
                'dir'          => 'ltr',
            ],
            'ar' => [
                'titre'        => 'التعرف الصوتي',
                'sous_titre'   => 'غنِّ أو رتِّل مقطعاً من خاصيدة لتحديدها',
                'btn_ecouter'  => 'ابدأ الاستماع',
                'btn_stop'     => 'إيقاف',
                'btn_relancer' => 'إعادة المحاولة',
                'ecoute'       => 'جار الاستماع…',
                'analyse'      => 'تحليل الإشارة…',
                'trouve'       => 'تم التعرف على الخاصيدة!',
                'non_trouve'   => 'لم يتم التعرف',
                'populaires'   => 'الخاصيدات الشهيرة',
                'ecouter'      => 'استمع',
                'conseil1'     => 'رتِّل بوضوح لمدة 5 ثوان على الأقل',
                'conseil2'     => 'قلِّل الضوضاء المحيطة لنتائج أفضل',
                'conseil3'     => 'أمسك الجهاز قريباً من مصدر الصوت',
                'conseil4'     => 'يُعرَّف على التلاوات البطيئة بشكل أفضل',
                'dir'          => 'rtl',
            ],
            'wo' => [
                'titre'        => 'Seet Xassida bi',
                'sous_titre'   => 'Dëkk xassida ak sa baat ngir seet ko',
                'btn_ecouter'  => 'Toog dégg',
                'btn_stop'     => 'Tëj',
                'btn_relancer' => 'Jëf ci kanam',
                'ecoute'       => 'Dafa dégg…',
                'analyse'      => 'Seet signal bi…',
                'trouve'       => 'Xassida bi da ko seet!',
                'non_trouve'   => 'Seet amul',
                'populaires'   => 'Xassida yi ñuy bëgg',
                'ecouter'      => 'Dégg',
                'conseil1'     => 'Dëkk ak yaram bu set 5 ségonn',
                'conseil2'     => 'Sëbb jëf ak nguir ci bët',
                'conseil3'     => 'Jox portable bi fi kaw son bi',
                'conseil4'     => 'Récitation yu yàgg dañu seet ko ak solo',
                'dir'          => 'ltr',
            ],
            'en' => [
                'titre'        => 'Voice Recognition',
                'sous_titre'   => 'Hum or sing a Xassida excerpt to identify it',
                'btn_ecouter'  => 'Start listening',
                'btn_stop'     => 'Stop',
                'btn_relancer' => 'Try again',
                'ecoute'       => 'Listening…',
                'analyse'      => 'Analyzing signal…',
                'trouve'       => 'Xassida identified!',
                'non_trouve'   => 'Not recognized',
                'populaires'   => 'Popular Xassidas',
                'ecouter'      => 'Listen',
                'conseil1'     => 'Hum clearly for at least 5 seconds',
                'conseil2'     => 'Reduce background noise for better detection',
                'conseil3'     => 'Hold the device close to the sound source',
                'conseil4'     => 'Slow recitations are recognized more accurately',
                'dir'          => 'ltr',
            ],
        ];

        return $textes[$lang] ?? $textes['fr'];
    }
}