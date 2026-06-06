<?php

class DouasController
{
    public function index(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // =========================================
        // LANGUE
        // =========================================

        $lang = $_SESSION['lang'] ?? 'fr';

        // =========================================
        // TRADUCTIONS
        // =========================================

        $textes = [

            'fr' => [
                'titre'     => 'Douas & Invocations',
                'sous_titre'=> 'Vos invocations quotidiennes en arabe avec traduction',
                'tous'      => 'Tous',
                'matin'     => '🌅 Matin',
                'soir'      => '🌙 Soir',
                'priere'    => '🕌 Après la prière',
                'quotidien' => '📅 Quotidien',
                'protection'=> '🛡️ Protection',
                'source'    => 'Source',
                'dir'       => 'ltr',
            ],

            'ar' => [
                'titre'     => 'الأدعية والأذكار',
                'sous_titre'=> 'أدعيتك اليومية بالعربية مع الترجمة',
                'tous'      => 'الكل',
                'matin'     => '🌅 الصباح',
                'soir'      => '🌙 المساء',
                'priere'    => '🕌 بعد الصلاة',
                'quotidien' => '📅 يومي',
                'protection'=> '🛡️ الحماية',
                'source'    => 'المصدر',
                'dir'       => 'rtl',
            ],

            'en' => [
                'titre'     => 'Duas & Invocations',
                'sous_titre'=> 'Your daily invocations in Arabic with translation',
                'tous'      => 'All',
                'matin'     => '🌅 Morning',
                'soir'      => '🌙 Evening',
                'priere'    => '🕌 After prayer',
                'quotidien' => '📅 Daily',
                'protection'=> '🛡️ Protection',
                'source'    => 'Source',
                'dir'       => 'ltr',
            ],

            'wo' => [
                'titre'     => 'Ñaan',
                'sous_titre'=> 'Seni Duwaa yi ngen di jëfandikoo',
                'tous'      => 'Yépp',
                'matin'     => '🌅 Souba',
                'soir'      => '🌙 Guddi',
                'priere'    => '🕌 Ci ginaaw salaate',
                'quotidien' => '📅 Bés bu ne',
                'protection'=> '🛡️ Aar',
                'source'    => 'Mbind mi',
                'dir'       => 'ltr',
            ],

        ];

        $traduction = $textes[$lang] ?? $textes['fr'];

        // =========================================
        // VUE
        // =========================================

        require_once __DIR__
            . '/../view/pages/vitrine/douas/listeDouas.php';
    }
}
$controller = new DouasController();
$controller->index();