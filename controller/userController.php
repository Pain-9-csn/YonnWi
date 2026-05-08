<?php
require_once __DIR__ . '/../model/DB.php';

class UserController
{
    private $pdo;

    public function __construct()
    {
        $db = new DB();
        $this->pdo = $db->getConnexion();
    }

    // ── CONNEXION ────────────────────────────────────────────
    public function login(string $email, string $password): array
    {
        $stmt = $this->pdo->prepare('SELECT * FROM utilisateur WHERE email = ? LIMIT 1');
        $stmt->execute([$email]);
        $utilisateur = $stmt->fetch();

        if ($utilisateur && password_verify($password, $utilisateur['password'])) {
            session_regenerate_id(true);
            $_SESSION['utilisateur_id']  = $utilisateur['id'];
            $_SESSION['utilisateur_nom'] = $utilisateur['nom'];
            return ['success' => true];
        }

        return ['success' => false, 'erreur' => 'Email ou mot de passe incorrect.'];
    }

    // ── INSCRIPTION ──────────────────────────────────────────
    public function register(string $nom, string $email, string $password): array
    {
        // Vérifier si l'email existe déjà
        $stmt = $this->pdo->prepare('SELECT id FROM utilisateur WHERE email = ? LIMIT 1');
        $stmt->execute([$email]);
        if ($stmt->fetch()) {
            return ['success' => false, 'erreur' => 'Cet email est déjà utilisé.'];
        }

        // Hasher le mot de passe et insérer
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->pdo->prepare('INSERT INTO utilisateur (nom, email, password) VALUES (?, ?, ?)');
        $stmt->execute([$nom, $email, $hash]);

        return ['success' => true];
    }

    // ── DÉCONNEXION ──────────────────────────────────────────
    public function logout(): void
    {
        session_unset();
        session_destroy();
    }

    // ── VÉRIFIER SI CONNECTÉ ─────────────────────────────────
    public function isLoggedIn(): bool
    {
        return isset($_SESSION['utilisateur_id']);
    }

    // ── UTILISATEUR COURANT ──────────────────────────────────
    public function getCurrentUser(): ?array
    {
        if (!$this->isLoggedIn()) return null;

        $stmt = $this->pdo->prepare('SELECT id, nom, email FROM utilisateur WHERE id = ?');
        $stmt->execute([$_SESSION['utilisateur_id']]);
        return $stmt->fetch() ?: null;
    }
}