<?php

require_once __DIR__ . '/../model/coranDB.php';

class CoranController
{
    private CoranDB $model;

    public function __construct()
    {
        $this->model = new CoranDB();
    }

    // =========================================
    // PAGE PRINCIPALE — accès libre
    // =========================================

    public function index(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $lang    = $_SESSION['lang'] ?? 'fr';
        $userId  = $_SESSION['user_id'] ?? null;

        $sourate = isset($_GET['sourate']) ? (int) $_GET['sourate'] : 1;
        $sourate = max(1, min(114, $sourate));

        $page    = isset($_GET['page']) ? (int) $_GET['page'] : 1;
        $page    = max(1, $page);

        $listeSourates = $this->model->getListeSourates();
        $versets       = $this->model->getVersets($sourate);
        $sourateMeta   = $this->model->getSourateMeta($sourate, $listeSourates);

        // Si connecté, reprendre là où on s'était arrêté
        $progression = null;
        if ($userId) {
            $progression = $this->model->getProgression($userId);
        }

        $textes = $this->getTextes($lang);

        require_once __DIR__ . '/../view/pages/vitrine/coran/coran.php';
    }

    // =========================================
    // AJAX — Versets d'une sourate (accès libre)
    // =========================================

    public function ajaxVersets(): void
    {
        header('Content-Type: application/json; charset=utf-8');

        $sourate = isset($_GET['sourate']) ? (int) $_GET['sourate'] : 1;
        $sourate = max(1, min(114, $sourate));

        $listeSourates = $this->model->getListeSourates();
        $versets       = $this->model->getVersets($sourate);
        $sourateMeta   = $this->model->getSourateMeta($sourate, $listeSourates);

        echo json_encode([
            'success' => true,
            'sourate' => $sourate,
            'meta'    => $sourateMeta,
            'versets' => $versets,
        ]);
    }

    // =========================================
    // AJAX — Sauvegarder progression
    // Silencieux si non connecté (pas d'erreur)
    // =========================================

    public function sauvegarderProgression(): void
    {
        header('Content-Type: application/json; charset=utf-8');

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $userId  = $_SESSION['user_id'] ?? null;
        $sourate = isset($_POST['sourate']) ? (int) $_POST['sourate'] : 1;
        $verset  = isset($_POST['verset'])  ? (int) $_POST['verset']  : 1;

        // Enregistrement seulement si connecté
        if ($userId) {
            $this->model->sauvegarderProgression($userId, $sourate, $verset);
        }

        echo json_encode(['success' => true, 'logged_in' => (bool) $userId]);
    }

    // =========================================
    // TEXTES UI MULTILINGUES
    // =========================================

    private function getTextes(string $lang): array
    {
        $textes = [
            'fr' => [
                'titre'      => 'Le Saint Coran',
                'sous_titre' => 'Lisez, écoutez et méditez la Parole d\'Allah',
                'sourates'   => 'Sourates',
                'versets'    => 'Versets',
                'recherche'  => 'Rechercher une sourate...',
                'mecquoise'  => 'Mecquoise',
                'medinoise'  => 'Médinoise',
                'bismillah'  => 'بِسْمِ اللهِ الرَّحْمٰنِ الرَّحِيْمِ',
                'dir'        => 'ltr',
            ],
            'ar' => [
                'titre'      => 'القرآن الكريم',
                'sous_titre' => 'اقرأ واستمع وتدبر كلام الله',
                'sourates'   => 'السور',
                'versets'    => 'الآيات',
                'recherche'  => 'ابحث عن سورة...',
                'mecquoise'  => 'مكية',
                'medinoise'  => 'مدنية',
                'bismillah'  => 'بِسْمِ اللهِ الرَّحْمٰنِ الرَّحِيْمِ',
                'dir'        => 'rtl',
            ],
            'wo' => [
                'titre'      => 'Al Quran Karim',
                'sous_titre' => 'Jàng, dégg ak xiif yaram yalla bi',
                'sourates'   => 'Sourate yi',
                'versets'    => 'Aaya yi',
                'recherche'  => 'Seet sourate...',
                'mecquoise'  => 'Makka',
                'medinoise'  => 'Madiina',
                'bismillah'  => 'بِسْمِ اللهِ الرَّحْمٰنِ الرَّحِيْمِ',
                'dir'        => 'ltr',
            ],
            'en' => [
                'titre'      => 'The Holy Quran',
                'sous_titre' => 'Read, listen and reflect upon the Word of Allah',
                'sourates'   => 'Surahs',
                'versets'    => 'Verses',
                'recherche'  => 'Search a surah...',
                'mecquoise'  => 'Meccan',
                'medinoise'  => 'Medinan',
                'bismillah'  => 'بِسْمِ اللهِ الرَّحْمٰنِ الرَّحِيْمِ',
                'dir'        => 'ltr',
            ],
        ];

        return $textes[$lang] ?? $textes['fr'];
    }
}