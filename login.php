<?php
// ── LOGIQUE PHP ──────────────────────────────────────────────────────────────
session_start();
require_once __DIR__ . '/model/DB.php';
require_once __DIR__ . '/controller/userController.php';

$controller = new UserController();

if ($controller->isLoggedIn()) {
    header('Location: index.php');
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email    = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    

    if (empty($email) || empty($password)) {
        $error = 'Veuillez remplir tous les champs.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Adresse email invalide.';
    } else {
        $resultat = $controller->login($email, $password);
        if ($resultat['success']) {
            header('Location: index.php');
            exit;
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
    <title>Se Connecter – YoonWi</title>
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
            max-width: 600px;
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

        h2 { margin: 0 0 15px; font-size: 28px; font-weight: 800; }

        p { margin: 0 0 16px; font-size: 15px; font-weight: 500; line-height: 22px; }

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
            padding: 45px 35px;
            display: flex;
        }
        .col-left {
            width: 45%;
            background: #4caf50;
            clip-path: polygon(
                98% 17%, 100% 34%, 98% 51%, 100% 68%,
                98% 84%, 100% 100%, 0 100%, 0 0, 100% 0
            );
        }
        .col-right { width: 55%; }

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
        .login-form p:last-child a:last-child { float: right; }

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
            letter-spacing: 1px;
            cursor: pointer;
        }
        .login-form input.btn:hover { color: #4caf50; background: #ffffff; }

        /* Alerte erreur */
        .alert-error {
            background: #fef2f2;
            border: 1px solid #fca5a5;
            color: #ef4444;
            border-radius: 5px;
            padding: 10px 14px;
            font-size: 13px;
            margin-bottom: 16px;
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

        <div class="col-left">
            <div class="login-text">
                <h2>YoonWi</h2>
                <p>Bienvenue sur votre plateforme. Connectez-vous pour accéder à votre espace personnel.</p>
                <a class="btn" href="register.php">S'inscrire</a>
            </div>
        </div>

        <div class="col-right">
            <div class="login-form">
                <h2>Connexion</h2>

                <?php if (!empty($erreur)): ?>
                <div class="alert-error">
                    ⚠️ <?= htmlspecialchars($erreur) ?>
                </div>
                <?php endif; ?>

                <form method="POST" action="login.php" novalidate>

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
                            placeholder="Mot de passe"
                            required
                            autocomplete="current-password"
                        />
                    </p>
                    <p>
                        <input class="btn" type="submit" value="Se Connecter" />
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