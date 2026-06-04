<?php

require_once __DIR__ . '/DB.php';

class CoranDB
{
    private PDO $pdo;

    // URL de base de l'API Al-Quran Cloud (gratuite, sans clé)
    private const API_BASE = 'https://api.alquran.cloud/v1';

    // Durée du cache en secondes (24h)
    private const CACHE_TTL = 86400;

    // Dossier de cache local
    private const CACHE_DIR = __DIR__ . '/../cache/coran/';

    public function __construct()
    {
        $db        = new DB();
        $this->pdo = $db->getConnexion();
        $this->initTable();
        $this->initCache();
    }

    private function initTable(): void
    {
        $this->pdo->exec("
            CREATE TABLE IF NOT EXISTS historique_coran (
                id          INT AUTO_INCREMENT PRIMARY KEY,
                user_id     INT          NOT NULL,
                sourate_num INT          NOT NULL DEFAULT 1,
                verset_num  INT          NOT NULL DEFAULT 1,
                updated_at  TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP
                            ON UPDATE CURRENT_TIMESTAMP,
                UNIQUE KEY uk_user (user_id)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
        ");
    }



    private function initCache(): void
    {
        if (!is_dir(self::CACHE_DIR)) {
            mkdir(self::CACHE_DIR, 0755, true);
        }
    }


    public function getListeSourates(): array
    {
        $cacheFile = self::CACHE_DIR . 'sourates.json';

        if ($this->cacheValide($cacheFile)) {
            return json_decode(file_get_contents($cacheFile), true);
        }

        $url      = self::API_BASE . '/surah';
        $response = $this->fetchApi($url);

        if (isset($response['data'])) {
            $sourates = $response['data'];
            file_put_contents($cacheFile, json_encode($sourates));
            return $sourates;
        }

        // Fallback minimal si API indisponible
        return $this->fallbackSourates();
    }



    public function getSourateMeta(int $num, array $listeSourates): array
    {
        foreach ($listeSourates as $s) {
            if ((int) $s['number'] === $num) {
                return $s;
            }
        }

        return [
            'number'               => $num,
            'name'                 => 'سورة',
            'englishName'          => 'Surah ' . $num,
            'englishNameTranslation' => '',
            'numberOfAyahs'        => 0,
            'revelationType'       => 'Meccan',
        ];
    }



    public function getVersets(int $sourate): array
    {
        $cacheFile = self::CACHE_DIR . "sourate_{$sourate}.json";

        if ($this->cacheValide($cacheFile)) {
            return json_decode(file_get_contents($cacheFile), true);
        }

        // Récupération arabe
        $urlAr  = self::API_BASE . "/surah/{$sourate}";
        $dataAr = $this->fetchApi($urlAr);

        // Récupération traduction française
        $urlFr  = self::API_BASE . "/surah/{$sourate}/fr.hamidullah";
        $dataFr = $this->fetchApi($urlFr);

        if (!isset($dataAr['data']['ayahs'])) {
            return [];
        }

        $ayahsAr = $dataAr['data']['ayahs'];
        $ayahsFr = $dataFr['data']['ayahs'] ?? [];

        // Fusion arabe + traduction
        $versets = [];
        foreach ($ayahsAr as $i => $ayah) {
            $versets[] = [
                'number'       => $ayah['numberInSurah'],
                'texteAr'      => $ayah['text'],
                'texteFr'      => $ayahsFr[$i]['text'] ?? '',
                'audio'        => "https://cdn.islamic.network/quran/audio/128/ar.alafasy/{$ayah['number']}.mp3",
            ];
        }

        file_put_contents($cacheFile, json_encode($versets));
        return $versets;
    }



    public function sauvegarderProgression(int $userId, int $sourate, int $verset): void
    {
        $stmt = $this->pdo->prepare("
            INSERT INTO historique_coran (user_id, sourate_num, verset_num)
            VALUES (:uid, :s, :v)
            ON DUPLICATE KEY UPDATE
                sourate_num = :s2,
                verset_num  = :v2
        ");

        $stmt->execute([
            ':uid' => $userId,
            ':s'   => $sourate,
            ':v'   => $verset,
            ':s2'  => $sourate,
            ':v2'  => $verset,
        ]);
    }



    public function getProgression(int $userId): array
    {
        $stmt = $this->pdo->prepare("
            SELECT sourate_num, verset_num
            FROM historique_coran
            WHERE user_id = :uid
            LIMIT 1
        ");
        $stmt->execute([':uid' => $userId]);
        $row = $stmt->fetch();

        return $row ?: ['sourate_num' => 1, 'verset_num' => 1];
    }


    private function fetchApi(string $url): array
    {
        $ctx = stream_context_create([
            'http' => [
                'timeout'        => 10,
                'ignore_errors'  => true,
                'method'         => 'GET',
            ],
        ]);

        $raw = @file_get_contents($url, false, $ctx);

        if (!$raw) {
            return [];
        }

        $data = json_decode($raw, true);
        return is_array($data) ? $data : [];
    }

    private function cacheValide(string $path): bool
    {
        return file_exists($path)
            && (time() - filemtime($path)) < self::CACHE_TTL;
    }

    // Fallback 5 sourates si l'API est hors ligne
    private function fallbackSourates(): array
    {
        return [
            ['number' => 1,  'name' => 'الفاتحة', 'englishName' => 'Al-Fatiha',  'numberOfAyahs' => 7,   'revelationType' => 'Meccan'],
            ['number' => 2,  'name' => 'البقرة',  'englishName' => 'Al-Baqara',  'numberOfAyahs' => 286, 'revelationType' => 'Medinan'],
            ['number' => 3,  'name' => 'آل عمران','englishName' => 'Ali Imran',  'numberOfAyahs' => 200, 'revelationType' => 'Medinan'],
            ['number' => 36, 'name' => 'يس',      'englishName' => 'Ya-Sin',     'numberOfAyahs' => 83,  'revelationType' => 'Meccan'],
            ['number' => 67, 'name' => 'الملك',   'englishName' => 'Al-Mulk',    'numberOfAyahs' => 30,  'revelationType' => 'Meccan'],
        ];
    }
}