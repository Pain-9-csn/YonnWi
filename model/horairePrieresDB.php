<?php
require_once __DIR__ . '/DB.php';

class HorairePrieresDB
{
    private $pdo;

    public function __construct()
    {
        $db = new DB();
        $this->pdo = $db->getConnexion();
    }

    public function sauvegarder(array $horaires): void
    {
        $stmt = $this->pdo->prepare(
            'INSERT INTO horairepriere (fadjr, souba, tisbar, takussan, timis, gue)
             VALUES (?, ?, ?, ?, ?, ?)'
        );
        $stmt->execute([
            $horaires['Fajr'],
            $horaires['Sunrise'],
            $horaires['Dhuhr'],
            $horaires['Asr'],
            $horaires['Maghrib'],
            $horaires['Isha'],
        ]);
    }
}