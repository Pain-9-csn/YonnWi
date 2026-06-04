<?php

class DouasController
{
    public function index(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // =========================================
        // VERSETS CORANIQUES VIA API
        // =========================================

        $versets = [
            'ayat_kursi'  => '2:255',
            'al_fatiha'   => '1:1-7',
            'al_ikhlas'   => '112:1-4',
            'al_falaq'    => '113:1-5',
            'an_nas'      => '114:1-6',
        ];

        $versetsData = [];

        foreach ($versets as $cle => $ref) {

            $url = "https://api.alquran.cloud/v1/surah/" 
                 . explode(':', $ref)[0] 
                 . "/ar.alafasy";

            $response = @file_get_contents($url);

            if ($response) {
                $data = json_decode($response, true);
                if (isset($data['data']['ayahs'])) {
                    $versetsData[$cle] = $data['data'];
                }
            }
        }

        // =========================================
        // VUE
        // =========================================

        require_once __DIR__
            . '/../view/pages/vitrine/douas/listeDouas.php';
    }
}