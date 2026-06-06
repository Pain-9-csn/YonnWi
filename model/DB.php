<?php
class DB
{
    private $host;
    private $dbname;
    private $user;
    private $password;  
    private $db;
    private $role;
    public function __construct()
    {
        $this->host     = getenv('DB_HOST') ?: 'localhost';
        $this->dbname   = getenv('DB_NAME') ?: 'yoonwi';
        $this->user     = getenv('DB_USER') ?: 'root';
        $this->password = getenv('DB_PASSWORD') ?: '';
        $this->role = getenv('DB_ROLE') ?: 'user';
        $this->connect();
    }

    private function connect()
    {
        $dsn = "mysql:host={$this->host};dbname={$this->dbname};charset=utf8";
        try {
            $this->db = new PDO($dsn, $this->user, $this->password);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $error) {
            die($error->getMessage());
        }
    }

    public function getConnexion()
    {
        return $this->db;
    }
}

function getConnexion()
{
    $db = new DB();
    return $db->getConnexion();
}