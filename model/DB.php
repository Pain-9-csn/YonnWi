<?php

class DB
{
    private string $host;
    private string $dbname;
    private string $user;
    private string $password;
    private PDO $db;

    public function __construct()
    {
        $this->host     = getenv('DB_HOST')     ?: 'localhost';
        $this->dbname   = getenv('DB_NAME')     ?: 'yoonwi';
        $this->user     = getenv('DB_USER')     ?: 'root';
        $this->password = getenv('DB_PASSWORD') ?: '';

        $this->connect();
    }

    private function connect(): void
    {
        $dsn = "mysql:host={$this->host};dbname={$this->dbname};charset=utf8mb4";

        try {
            $this->db = new PDO($dsn, $this->user, $this->password, [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ]);
        } catch (PDOException $e) {
            // Message d'erreur lisible pour le debug (à désactiver en prod)
            error_log("Erreur DB : " . $e->getMessage());
            die("Erreur de connexion à la base de données. Vérifiez vos paramètres.");
        }
    }

    public function getConnexion(): PDO
    {
        return $this->db;
    }
}