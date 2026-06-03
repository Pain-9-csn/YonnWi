<?php

class Khassida
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = new PDO(
            "mysql:host=localhost;dbname=yoonwi",
            "root",
            ""
        );
    }

    public function getAllKhassidas()
    {
        $sql = "SELECT * FROM xassaide ORDER BY id DESC";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}