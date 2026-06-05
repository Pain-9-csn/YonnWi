<?php

require_once __DIR__ . '/DB.php';

class CaptureAudioDB
{
    private PDO $pdo;

    public function __construct()
    {
        $db        = new DB();
        $this->pdo = $db->getConnexion();
        $this->initTables();
    }

    // =========================================
    // INIT TABLES
    // =========================================

    private function initTables(): void
    {
        // Table des captures vocales (historique)
        $this->pdo->exec("
            CREATE TABLE IF NOT EXISTS capture_audio (
                id             INT AUTO_INCREMENT PRIMARY KEY,
                user_id        INT          DEFAULT NULL,
                xassida_id     INT          DEFAULT NULL,
                duree_sec      INT          DEFAULT 0,
                fingerprint    TEXT         DEFAULT NULL COMMENT 'Hash spectral du segment',
                reconnu        TINYINT(1)   NOT NULL DEFAULT 0,
                created_at     TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,
                INDEX idx_user     (user_id),
                INDEX idx_xassida  (xassida_id)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
        ");

        // Table des empreintes spectrales (fingerprints) des xassidas
        $this->pdo->exec("
            CREATE TABLE IF NOT EXISTS xassida_fingerprint (
                id             INT AUTO_INCREMENT PRIMARY KEY,
                xassida_id     INT          NOT NULL,
                fingerprint    VARCHAR(255) NOT NULL COMMENT 'Hash spectral de référence',
                segment_debut  INT          DEFAULT 0 COMMENT 'Offset en secondes',
                created_at     TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,
                INDEX idx_fp   (fingerprint),
                INDEX idx_xid  (xassida_id)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
        ");
    }

    // =========================================
    // XASSIDAS POPULAIRES (pour la liste d'accueil)
    // =========================================

    public function getXassidasPopulaires(int $limite = 8): array
    {
        $stmt = $this->pdo->prepare("
            SELECT
                x.id,
                x.titre,
                x.auteur,
                x.audio_url,
                x.image_url,
                x.description,
                COUNT(c.id) AS nb_ecoutes
            FROM xassaide x
            LEFT JOIN capture_audio c ON c.xassida_id = x.id AND c.reconnu = 1
            GROUP BY x.id
            ORDER BY nb_ecoutes DESC, x.id ASC
            LIMIT :lim
        ");
        $stmt->bindValue(':lim', $limite, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    // =========================================
    // RECHERCHE PAR FINGERPRINT SPECTRAL
    //
    // Stratégie : correspondance exacte d'abord,
    // puis correspondance partielle si disponible.
    // =========================================

    public function rechercherParFingerprint(string $fingerprint): ?array
    {
        // 1. Correspondance exacte
        $stmt = $this->pdo->prepare("
            SELECT
                x.id,
                x.titre,
                x.auteur,
                x.audio_url,
                x.image_url,
                x.description
            FROM xassida_fingerprint fp
            JOIN xassaide x ON x.id = fp.xassida_id
            WHERE fp.fingerprint = :fp
            LIMIT 1
        ");
        $stmt->execute([':fp' => $fingerprint]);
        $row = $stmt->fetch();

        if ($row) {
            return $row;
        }

        // 2. Correspondance partielle (début du fingerprint)
        //    Utile si le hash est tronqué côté client
        $partiel = substr($fingerprint, 0, 16);
        $stmt2 = $this->pdo->prepare("
            SELECT
                x.id,
                x.titre,
                x.auteur,
                x.audio_url,
                x.image_url,
                x.description
            FROM xassida_fingerprint fp
            JOIN xassaide x ON x.id = fp.xassida_id
            WHERE fp.fingerprint LIKE :fp
            LIMIT 1
        ");
        $stmt2->execute([':fp' => $partiel . '%']);

        return $stmt2->fetch() ?: null;
    }

    // =========================================
    // SAUVEGARDER UNE CAPTURE
    // =========================================

    public function sauvegarderCapture(
        ?int $userId,
        ?int $xassidaId,
        int $duree,
        string $fingerprint
    ): int {
        $stmt = $this->pdo->prepare("
            INSERT INTO capture_audio
                (user_id, xassida_id, duree_sec, fingerprint, reconnu)
            VALUES
                (:uid, :xid, :dur, :fp, :rec)
        ");

        $stmt->execute([
            ':uid' => $userId,
            ':xid' => $xassidaId,
            ':dur' => $duree,
            ':fp'  => substr($fingerprint, 0, 255),
            ':rec' => $xassidaId ? 1 : 0,
        ]);

        return (int) $this->pdo->lastInsertId();
    }

    // =========================================
    // STATISTIQUES DE RECONNAISSANCE
    // =========================================

    public function getStats(): array
    {
        $stmt = $this->pdo->query("
            SELECT
                COUNT(*) AS total,
                SUM(reconnu) AS reconnus,
                COUNT(DISTINCT xassida_id) AS xassidas_distincts
            FROM capture_audio
        ");
        return $stmt->fetch() ?: ['total' => 0, 'reconnus' => 0, 'xassidas_distincts' => 0];
    }

    // =========================================
    // AJOUTER UN FINGERPRINT DE RÉFÉRENCE (admin)
    // =========================================

    public function ajouterFingerprint(
        int $xassidaId,
        string $fingerprint,
        int $segmentDebut = 0
    ): void {
        $stmt = $this->pdo->prepare("
            INSERT IGNORE INTO xassida_fingerprint
                (xassida_id, fingerprint, segment_debut)
            VALUES
                (:xid, :fp, :seg)
        ");
        $stmt->execute([
            ':xid' => $xassidaId,
            ':fp'  => $fingerprint,
            ':seg' => $segmentDebut,
        ]);
    }
}