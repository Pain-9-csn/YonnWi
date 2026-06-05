<?php

require_once __DIR__ . '/../model/DB.php';

class UserController
{
    private PDO $pdo;

    public function __construct()
    {
        $db        = new DB();
        $this->pdo = $db->getConnexion();
    }

    // =========================================
    // UTILITAIRE : l'utilisateur est-il connecté ?
    // N'est JAMAIS bloquant — sert uniquement à
    // activer les fonctionnalités d'historique.
    // =========================================

    public function isLoggedIn(): bool
    {
        return !empty($_SESSION['user_id']);
    }

    // =========================================
    // UTILITAIRE : ID de l'utilisateur courant
    // Retourne null si non connecté
    // =========================================

    public function getUserId(): ?int
    {
        return $_SESSION['user_id'] ?? null;
    }

    // =========================================
    // CONNEXION
    // =========================================

    public function login(string $email, string $password): array
    {
        try {
            $stmt = $this->pdo->prepare(
                "SELECT id, nom, email, password, role
                 FROM users
                 WHERE email = :email
                 LIMIT 1"
            );
            $stmt->execute([':email' => $email]);
            $user = $stmt->fetch();

            if (!$user) {
                return ['success' => false, 'erreur' => 'Adresse email introuvable.'];
            }

            if (!password_verify($password, $user['password'])) {
                return ['success' => false, 'erreur' => 'Mot de passe incorrect.'];
            }

            // Stocker les infos en session
            $_SESSION['user_id']   = $user['id'];
            $_SESSION['user_nom']  = $user['nom'];
            $_SESSION['user_role'] = $user['role'] ?? 'user';
            $_SESSION['actif']     = true;

            return ['success' => true];

        } catch (PDOException $e) {
            return ['success' => false, 'erreur' => 'Erreur de base de données.'];
        }
    }

    // =========================================
    // INSCRIPTION
    // =========================================

    public function register(string $nom, string $email, string $password): array
    {
        try {
            // Vérifier si l'email existe déjà
            $stmt = $this->pdo->prepare(
                "SELECT id FROM users WHERE email = :email LIMIT 1"
            );
            $stmt->execute([':email' => $email]);

            if ($stmt->fetch()) {
                return ['success' => false, 'erreur' => 'Cet email est déjà utilisé.'];
            }

            // Créer le compte
            $hash = password_hash($password, PASSWORD_DEFAULT);

            $stmt = $this->pdo->prepare(
                "INSERT INTO users (nom, email, password, role, created_at)
                 VALUES (:nom, :email, :password, 'user', NOW())"
            );
            $stmt->execute([
                ':nom'      => $nom,
                ':email'    => $email,
                ':password' => $hash,
            ]);

            return ['success' => true];

        } catch (PDOException $e) {
            return ['success' => false, 'erreur' => 'Erreur lors de la création du compte.'];
        }
    }

    // =========================================
    // MIDDLEWARE ADMIN — UNIQUEMENT pour admin.php
    // Redirige vers login si non connecté ou non admin
    // =========================================

    public function requireAdmin(): void
    {
        if (!$this->isLoggedIn()) {
            $_SESSION['redirect_apres_login'] = 'admin.php';
            header('Location: login.php');
            exit;
        }

        if (($_SESSION['user_role'] ?? '') !== 'admin') {
            header('Location: index.php');
            exit;
        }
    }

    // =========================================
    // INIT TABLE USERS (si elle n'existe pas encore)
    // =========================================

    public function initTable(): void
    {
        $this->pdo->exec("
            CREATE TABLE IF NOT EXISTS users (
                id         INT AUTO_INCREMENT PRIMARY KEY,
                nom        VARCHAR(100)  NOT NULL,
                email      VARCHAR(150)  NOT NULL UNIQUE,
                password   VARCHAR(255)  NOT NULL,
                role       ENUM('user','admin') NOT NULL DEFAULT 'user',
                created_at TIMESTAMP     NOT NULL DEFAULT CURRENT_TIMESTAMP
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
        ");
    }
}