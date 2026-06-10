<?php

require_once __DIR__ . '/../model/DB.php';

class UserController
{
    private PDO $pdo;

    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $db        = new DB();
        $this->pdo = $db->getConnexion();
    }

    // ─────────────────────────────────────────────
    // Helpers session
    // ─────────────────────────────────────────────

    public function isLoggedIn(): bool
    {
        return !empty($_SESSION['user_id']);
    }

    public function getUserId(): ?int
    {
        return isset($_SESSION['user_id']) ? (int) $_SESSION['user_id'] : null;
    }

    public function getRole(): string
    {
        return $_SESSION['user_role'] ?? 'user';
    }

    public function isAdmin(): bool
    {
        return $this->isLoggedIn() && $this->getRole() === 'admin';
    }

    // ─────────────────────────────────────────────
    // Connexion
    // ─────────────────────────────────────────────

    public function login(string $email, string $password): array
    {
        try {
            $stmt = $this->pdo->prepare(
                "SELECT id, nom, email, password, role
                 FROM utilisateur
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
            $_SESSION['user_id']   = (int) $user['id'];
            $_SESSION['user_nom']  = $user['nom'];
            $_SESSION['user_role'] = $user['role'] ?? 'user';
            $_SESSION['actif']     = true;

            return ['success' => true, 'role' => $_SESSION['user_role']];

        } catch (PDOException $e) {
            error_log("Login error : " . $e->getMessage());
            return ['success' => false, 'erreur' => 'Erreur de base de données.'];
        }
    }

    // ─────────────────────────────────────────────
    // Inscription
    // ─────────────────────────────────────────────

    public function register(string $nom, string $email, string $password): array
    {
        try {
            // Vérifier si l'email existe déjà
            $stmt = $this->pdo->prepare(
                "SELECT id FROM utilisateur WHERE email = :email LIMIT 1"
            );
            $stmt->execute([':email' => $email]);

            if ($stmt->fetch()) {
                return ['success' => false, 'erreur' => 'Cet email est déjà utilisé.'];
            }

            // Créer le compte
            $hash = password_hash($password, PASSWORD_DEFAULT);

            $stmt = $this->pdo->prepare(
                "INSERT INTO utilisateur (nom, email, password, role, created_at)
                 VALUES (:nom, :email, :password, 'user', NOW())"
            );

            // ✅ FIX : les clés correspondent exactement aux placeholders
            $stmt->execute([
                ':nom'      => $nom,
                ':email'    => $email,
                ':password' => $hash,
            ]);

            return ['success' => true];

        } catch (PDOException $e) {
            error_log("Register error : " . $e->getMessage());
            return ['success' => false, 'erreur' => 'Erreur lors de la création du compte. (' . $e->getMessage() . ')'];
        }
    }

    // ─────────────────────────────────────────────
    // Protection des pages
    // ─────────────────────────────────────────────

    /** Redirige vers login si pas connecté */
    public function requireLogin(): void
    {
        if (!$this->isLoggedIn()) {
            $_SESSION['redirect_apres_login'] = $_SERVER['REQUEST_URI'];
            header('Location: login.php');
            exit;
        }
    }

    /** Redirige vers accueil si pas admin */
    public function requireAdmin(): void
    {
        $this->requireLogin();

        if (!$this->isAdmin()) {
            header('Location: index.php');
            exit;
        }
    }

    // ─────────────────────────────────────────────
    // Déconnexion
    // ─────────────────────────────────────────────

    public function logout(): void
    {
        $_SESSION = [];
        if (ini_get("session.use_cookies")) {
            $p = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $p["path"], $p["domain"], $p["secure"], $p["httponly"]
            );
        }
        session_destroy();
        header('Location: login.php');
        exit;
    }

    // ─────────────────────────────────────────────
    // Init table (à appeler une seule fois)
    // ─────────────────────────────────────────────

    public function initTable(): void
    {
        $this->pdo->exec("
            CREATE TABLE IF NOT EXISTS utilisateur (
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