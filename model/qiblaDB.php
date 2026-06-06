<?php

require_once __DIR__ . '/DB.php';

class QiblaDB
{
    private PDO $pdo;

    // Coordonnées fixes de la Kaaba (Mecque)
    private const MECCA_LAT = 21.4225;
    private const MECCA_LNG = 39.8262;

    // Rayon moyen de la Terre en km
    private const EARTH_RADIUS = 6371.0;

    public function __construct()
    {
        $db        = new DB();
        $this->pdo = $db->getConnexion();
        $this->initTable();
    }

    // =========================================
    // INIT TABLE HISTORIQUE LOCALISATIONS
    // =========================================

    private function initTable(): void
    {
        $this->pdo->exec("
            CREATE TABLE IF NOT EXISTS historique_qibla (
                id          INT AUTO_INCREMENT PRIMARY KEY,
                user_id     INT            NOT NULL,
                latitude    DECIMAL(10,7)  NOT NULL,
                longitude   DECIMAL(10,7)  NOT NULL,
                direction   DECIMAL(6,2)   NOT NULL COMMENT 'Degrés depuis le nord (0-360)',
                distance_km DECIMAL(8,2)   DEFAULT NULL,
                created_at  TIMESTAMP      NOT NULL DEFAULT CURRENT_TIMESTAMP
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
        ");
    }

    // =========================================
    // CALCUL DE LA DIRECTION QIBLA (formule orthodromique)
    //
    //   θ = atan2(
    //         sin(Δλ)·cos(φ₂),
    //         cos(φ₁)·sin(φ₂) − sin(φ₁)·cos(φ₂)·cos(Δλ)
    //       )
    //   Résultat en degrés depuis le nord (0-360)
    // =========================================

    public function calculerQibla(float $lat, float $lng): float
    {
        $lat1 = deg2rad($lat);
        $lng1 = deg2rad($lng);
        $lat2 = deg2rad(self::MECCA_LAT);
        $lng2 = deg2rad(self::MECCA_LNG);

        $dLng = $lng2 - $lng1;

        $y = sin($dLng) * cos($lat2);
        $x = cos($lat1) * sin($lat2) - sin($lat1) * cos($lat2) * cos($dLng);

        $bearing = atan2($y, $x);
        $bearing = rad2deg($bearing);

        // Normaliser entre 0 et 360
        return fmod(($bearing + 360), 360);
    }

    // =========================================
    // CALCUL DE LA DISTANCE JUSQU'À LA MECQUE (formule haversine)
    // =========================================

    public function calculerDistance(float $lat, float $lng): float
    {
        $lat1 = deg2rad($lat);
        $lng1 = deg2rad($lng);
        $lat2 = deg2rad(self::MECCA_LAT);
        $lng2 = deg2rad(self::MECCA_LNG);

        $dLat = $lat2 - $lat1;
        $dLng = $lng2 - $lng1;

        $a = sin($dLat / 2) ** 2
            + cos($lat1) * cos($lat2) * sin($dLng / 2) ** 2;

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        return self::EARTH_RADIUS * $c;
    }

    // =========================================
    // SAUVEGARDE LOCALISATION UTILISATEUR
    // =========================================

    public function sauvegarderLocalisation(
        int $userId,
        float $lat,
        float $lng,
        float $direction
    ): void {
        $distance = $this->calculerDistance($lat, $lng);

        $stmt = $this->pdo->prepare("
            INSERT INTO historique_qibla
                (user_id, latitude, longitude, direction, distance_km)
            VALUES
                (:uid, :lat, :lng, :dir, :dist)
        ");

        $stmt->execute([
            ':uid'  => $userId,
            ':lat'  => $lat,
            ':lng'  => $lng,
            ':dir'  => round($direction, 2),
            ':dist' => round($distance, 2),
        ]);
    }

    // =========================================
    // DERNIÈRE LOCALISATION D'UN UTILISATEUR
    // =========================================

    public function getDerniereLocalisation(int $userId): ?array
    {
        $stmt = $this->pdo->prepare("
            SELECT latitude, longitude, direction, distance_km, created_at
            FROM historique_qibla
            WHERE user_id = :uid
            ORDER BY created_at DESC
            LIMIT 1
        ");
        $stmt->execute([':uid' => $userId]);
        $row = $stmt->fetch();

        return $row ?: null;
    }

    // =========================================
    // HISTORIQUE DES LOCALISATIONS D'UN UTILISATEUR
    // =========================================

    public function getHistorique(int $userId, int $limit = 10): array
    {
        $stmt = $this->pdo->prepare("
            SELECT latitude, longitude, direction, distance_km, created_at
            FROM historique_qibla
            WHERE user_id = :uid
            ORDER BY created_at DESC
            LIMIT :lim
        ");
        $stmt->bindValue(':uid', $userId, PDO::PARAM_INT);
        $stmt->bindValue(':lim', $limit,  PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll();
    }
}