<?php
// ── LOGIQUE PHP ──────────────────────────────────────────────────────────────
session_start();
require_once __DIR__ . '/model/DB.php';
require_once __DIR__ . '/controller/userController.php';

$controller = new UserController();

// Si déjà connecté, rediriger
if ($controller->isLoggedIn()) {
    header('Location: index.php');
    exit;
}

$error  = '';
$succes  = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom      = trim($_POST['nom'] ?? '');
    $email    = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm  = $_POST['confirm'] ?? '';

    if (empty($nom) || empty($email) || empty($password) || empty($confirm)) {
        $error = 'Veuillez remplir tous les champs.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Adresse email invalide.';
    } elseif (strlen($password) < 6) {
        $error = 'Le mot de passe doit contenir au moins 6 caractères.';
    } elseif ($password !== $confirm) {
        $error = 'Les mots de passe ne correspondent pas.';
    } else {
        $resultat = $controller->register($nom, $email, $password);
        if ($resultat['success']) {
            $succes = 'Compte créé avec succès ! Vous pouvez vous connecter.';
        } else {
            $error = $resultat['erreur'];
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>S'inscrire – YoonWi</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet"/>
    <style>
        *,*::before,*::after { box-sizing: border-box; }

        body {
            margin: 0;
            font-family: 'Nunito', Arial, sans-serif;
            font-size: 16px;
            font-weight: 400;
            color: #666666;
            background: #eaeff4;
        }

        .wrapper {
            margin: 0 auto;
            width: 100%;
            max-width: 1140px;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }

        .container {
            position: relative;
            width: 100%;
            max-width: 640px;
            display: flex;
            background: #ffffff;
            box-shadow: 0 0 15px rgba(0,0,0,.1);
        }

        .credit {
            margin: 25px auto 0;
            text-align: center;
            color: #666;
            font-size: 14px;
        }
        .credit a { color: #222; font-weight: 600; text-decoration: none; }

        h2 { margin: 0 0 15px; font-size: 26px; font-weight: 800; }

        p { margin: 0 0 14px; font-size: 15px; font-weight: 500; line-height: 22px; }

        .btn {
            display: inline-block;
            padding: 8px 22px;
            font-size: 15px;
            font-family: 'Nunito', Arial, sans-serif;
            font-weight: 700;
            letter-spacing: 1px;
            text-decoration: none;
            border-radius: 5px;
            color: #ffffff;
            border: 1px solid #ffffff;
            cursor: pointer;
            transition: 0.3s;
        }
        .btn:hover { color: #4caf50; background: #ffffff; }

        .col-left, .col-right {
            padding: 40px 32px;
            display: flex;
        }
        .col-left {
            width: 42%;
            background: #4caf50;
            clip-path: polygon(
                98% 17%, 100% 34%, 98% 51%, 100% 68%,
                98% 84%, 100% 100%, 0 100%, 0 0, 100% 0
            );
        }
        .col-right { width: 58%; }

        .login-text {
            width: 100%;
            color: #ffffff;
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
        .login-text p { font-size: 14px; opacity: .9; }

        .login-form { width: 100%; }
        .login-form p:last-child { margin: 0; }
        .login-form p a { color: #4caf50; font-size: 14px; text-decoration: none; font-weight: 600; }

        .login-form input {
            display: block;
            width: 100%;
            height: 40px;
            padding: 0 12px;
            font-size: 15px;
            font-family: 'Nunito', Arial, sans-serif;
            outline: none;
            border: 1px solid #cccccc;
            border-radius: 5px;
            transition: border-color .2s;
            background: #fff;
            color: #333;
        }
        .login-form input:focus { border-color: #4caf50; }
        .login-form input.btn {
            color: #ffffff;
            background: #4caf50;
            border-color: #4caf50;
            font-weight: 700;
            cursor: pointer;
        }
        .login-form input.btn:hover { color: #4caf50; background: #ffffff; }

        .alert-error {
            background: #fef2f2;
            border: 1px solid #fca5a5;
            color: #ef4444;
            border-radius: 5px;
            padding: 10px 14px;
            font-size: 13px;
            margin-bottom: 14px;
        }

        .alert-success {
            background: #f0fdf4;
            border: 1px solid #86efac;
            color: #16a34a;
            border-radius: 5px;
            padding: 10px 14px;
            font-size: 13px;
            margin-bottom: 14px;
        }

        @media (max-width: 575.98px) {
            .container { flex-direction: column; box-shadow: none; }
            .col-left, .col-right { width: 100%; padding: 30px; clip-path: none; }
        }
    </style>
</head>
<body>

<div class="wrapper">
    <div class="container">

        <!-- COLONNE GAUCHE -->
        <div class="col-left">
            <div class="login-text">
                <h2>YoonWi</h2>
                <p>Déjà un compte ? Connectez-vous pour accéder à votre espace.</p>
                <a class="btn" href="login.php">Se Connecter</a>
            </div>
        </div>

        <!-- COLONNE DROITE -->
        <div class="col-right">
            <div class="login-form">
                <h2>Inscription</h2>

                <?php if (!empty($erreur)): ?>
                <div class="alert-error">⚠️ <?= htmlspecialchars($erreur) ?></div>
                <?php endif; ?>

                <?php if (!empty($succes)): ?>
                <div class="alert-success">✅ <?= htmlspecialchars($succes) ?></div>
                <?php endif; ?>

                <form method="POST" action="register.php" novalidate>

                    <p>
                        <input
                            type="text"
                            name="nom"
                            placeholder="Nom complet"
                            value="<?= htmlspecialchars($_POST['nom'] ?? '') ?>"
                            required
                        />
                    </p>

                    <p>
                        <input
                            type="email"
                            name="email"
                            placeholder="Adresse email"
                            value="<?= htmlspecialchars($_POST['email'] ?? '') ?>"
                            required
                            autocomplete="email"
                        />
                    </p>

                    <p>
                        <input
                            type="password"
                            name="password"
                            placeholder="Mot de passe (min. 6 caractères)"
                            required
                            autocomplete="new-password"
                        />
                    </p>

                    <p>
                        <input
                            type="password"
                            name="confirm"
                            placeholder="Confirmer le mot de passe"
                            required
                            autocomplete="new-password"
                        />
                    </p>

                    <p>
                        <input class="btn" type="submit" value="Créer mon compte" />
                    </p>

                    <p style="text-align:center; margin-top: 8px;">
                        <a href="login.php">Déjà un compte ? Se connecter</a>
                    </p>

                </form>
            </div>
        </div>

    </div>

    <div class="credit">
        © Copyright <strong>YoonWi</strong> — Tous droits réservés
    </div>
</div>

</body>
</html>