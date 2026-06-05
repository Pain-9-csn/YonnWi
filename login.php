<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Si déjà connecté → accueil (pas admin, juste accueil)
if (isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}

require_once __DIR__ . '/model/DB.php';
require_once __DIR__ . '/controller/userController.php';

$controller = new UserController();

$error   = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // ----------------------------------------
    // CONNEXION
    // ----------------------------------------
    if (isset($_POST['login'])) {

        $email    = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';

        if (empty($email) || empty($password)) {
            $error = "Veuillez remplir tous les champs.";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = "Adresse email invalide.";
        } else {
            $resultat = $controller->login($email, $password);

            if ($resultat['success']) {
                // Rediriger vers la page d'où l'on venait, ou l'accueil
                $retour = $_SESSION['redirect_apres_login'] ?? 'index.php';
                unset($_SESSION['redirect_apres_login']);
                header('Location: ' . $retour);
                exit;
            } else {
                $error = $resultat['erreur'];
            }
        }
    }

    // ----------------------------------------
    // INSCRIPTION
    // ----------------------------------------
    if (isset($_POST['register'])) {

        $nom      = trim($_POST['nom'] ?? '');
        $email    = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';
        $confirm  = $_POST['confirm'] ?? '';

        if (empty($nom) || empty($email) || empty($password) || empty($confirm)) {
            $error = "Veuillez remplir tous les champs.";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = "Adresse email invalide.";
        } elseif (strlen($password) < 6) {
            $error = "Le mot de passe doit contenir au moins 6 caractères.";
        } elseif ($password !== $confirm) {
            $error = "Les mots de passe ne correspondent pas.";
        } else {
            $resultat = $controller->register($nom, $email, $password);

            if ($resultat['success']) {
                $success = "Compte créé avec succès. Vous pouvez vous connecter.";
            } else {
                $error = $resultat['erreur'];
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YoonWi — Connexion</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --accent-color: #71c55d;
            --soft-bg: color-mix(in srgb, var(--accent-color), transparent 90%);
            --soft-border: color-mix(in srgb, var(--accent-color), transparent 75%);
            --dark: #1f2937;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background:
                radial-gradient(circle at top left, color-mix(in srgb, var(--accent-color), white 85%), transparent 35%),
                radial-gradient(circle at bottom right, color-mix(in srgb, var(--accent-color), white 88%), transparent 40%),
                #f7faf7;
            font-family: 'Nunito', sans-serif;
            padding: 20px;
        }

        .container {
            position: relative;
            width: 920px;
            max-width: 100%;
            height: auto;
            min-height: 580px;
            background: #fff;
            border-radius: 30px;
            overflow: hidden;
            border: 1px solid var(--soft-border);
            box-shadow: 0 10px 40px rgba(113, 197, 93, .10), 0 2px 8px rgba(0, 0, 0, .04);
        }

        .container::before {
            content: '';
            position: absolute;
            inset: 0;
            background-image: radial-gradient(circle at center, color-mix(in srgb, var(--accent-color), transparent 93%) 2px, transparent 2px);
            background-size: 32px 32px;
            pointer-events: none;
        }

        /* Lien "continuer sans compte" */
        .guest-link {
            text-align: center;
            margin-top: 12px;
            font-size: 13px;
            color: #6b7280;
        }

        .guest-link a {
            color: var(--accent-color);
            text-decoration: none;
            font-weight: 700;
        }

        .guest-link a:hover {
            text-decoration: underline;
        }

        .form-container {
            position: absolute;
            top: 0;
            width: 50%;
            height: 100%;
            padding: 50px;
            transition: all .7s cubic-bezier(.77, 0, .18, 1);
            z-index: 2;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .sign-in {
            left: 0;
        }

        .sign-up {
            left: 0;
            opacity: 0;
            z-index: 1;
        }

        .container.active .sign-in {
            transform: translateX(100%);
            opacity: 0;
        }

        .container.active .sign-up {
            transform: translateX(100%);
            opacity: 1;
            z-index: 5;
        }

        form {
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        h2 {
            font-size: 34px;
            margin-bottom: 8px;
            color: var(--dark);
            font-weight: 800;
        }

        .subtitle {
            color: #6b7280;
            margin-bottom: 24px;
            line-height: 24px;
            font-size: 14px;
        }

        input {
            width: 100%;
            height: 52px;
            border: none;
            outline: none;
            border-radius: 16px;
            padding: 0 18px;
            margin-bottom: 14px;
            font-size: 15px;
            background: var(--soft-bg);
            border: 1px solid transparent;
            transition: .3s;
            color: #1f2937;
        }

        input:focus {
            border-color: var(--accent-color);
            background: #fff;
            box-shadow: 0 0 0 5px color-mix(in srgb, var(--accent-color), transparent 85%);
        }

        button {
            position: relative;
            overflow: hidden;
            width: 100%;
            height: 52px;
            border: none;
            border-radius: 16px;
            background: linear-gradient(135deg, #71c55d, #5fb04d);
            color: #fff;
            font-size: 15px;
            font-weight: 800;
            letter-spacing: .5px;
            cursor: pointer;
            transition: .35s ease;
            margin-top: 8px;
            box-shadow: 0 10px 25px rgba(113, 197, 93, .28);
        }

        button:hover {
            transform: translateY(-3px);
            box-shadow: 0 14px 30px rgba(113, 197, 93, .35);
        }

        button:active {
            transform: scale(.98);
        }

        .overlay {
            position: absolute;
            top: 0;
            left: 50%;
            width: 50%;
            height: 100%;
            transition: all .7s cubic-bezier(.77, 0, .18, 1);
            background: linear-gradient(145deg, #71c55d, #5fb04d);
            overflow: hidden;
        }

        .overlay::before {
            content: '☪';
            position: absolute;
            top: 40px;
            right: 50px;
            font-size: 180px;
            color: rgba(255, 255, 255, .08);
            font-weight: bold;
        }

        .overlay::after {
            content: '';
            position: absolute;
            inset: 0;
            background-image: radial-gradient(rgba(255, 255, 255, .08) 1px, transparent 1px);
            background-size: 24px 24px;
        }

        .container.active .overlay {
            transform: translateX(-100%);
        }

        .overlay-content {
            position: relative;
            z-index: 2;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 50px;
            color: #fff;
        }

        .logo {
            width: 90px;
            height: 90px;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            background: rgba(255, 255, 255, .15);
            backdrop-filter: blur(10px);
            margin-bottom: 25px;
            font-size: 42px;
        }

        .overlay h1 {
            font-size: 46px;
            margin-bottom: 18px;
            font-weight: 800;
        }

        .overlay p {
            line-height: 30px;
            font-size: 16px;
            max-width: 340px;
            opacity: .96;
            margin-bottom: 34px;
        }

        .switch-btn {
            width: auto;
            min-width: 220px;
            background: rgba(255, 255, 255, .12);
            border: 1px solid rgba(255, 255, 255, .25);
            backdrop-filter: blur(10px);
            box-shadow: none;
        }

        .switch-btn:hover {
            background: #fff;
            color: #5fb04d;
        }

        .alert {
            padding: 12px 16px;
            border-radius: 14px;
            margin-bottom: 16px;
            font-size: 14px;
            font-weight: 600;
        }

        .error {
            background: #fff1f1;
            color: #dc2626;
            border: 1px solid #fecaca;
        }

        .success {
            background: #f0fdf4;
            color: #15803d;
            border: 1px solid #bbf7d0;
        }

        @media (max-width: 768px) {
            .container {
                width: 100%;
                height: auto;
            }

            .overlay {
                display: none;
            }

            .form-container {
                position: relative;
                width: 100%;
                transform: none !important;
                opacity: 1 !important;
                padding: 40px 25px;
            }

            .sign-up {
                display: none;
            }

            .container.active .sign-up {
                display: block;
            }

            .container.active .sign-in {
                display: none;
            }

            h2 {
                font-size: 28px;
            }
        }
    </style>
</head>

<body>
    <div class="container" id="container">

        <!-- CONNEXION -->
        <div class="form-container sign-in">
            <form method="POST">
                <h2>Connexion</h2>
                <p class="subtitle">Accédez à votre espace spirituel YoonWi</p>

                <?php if ($error): ?>
                    <div class="alert error"><?= htmlspecialchars($error) ?></div>
                <?php endif; ?>
                <?php if ($success): ?>
                    <div class="alert success"><?= htmlspecialchars($success) ?></div>
                <?php endif; ?>

                <input type="email" name="email" placeholder="Adresse email" required>
                <input type="password" name="password" placeholder="Mot de passe" required>
                <button type="submit" name="login">Se connecter</button>

                <div class="guest-link">
                    <a href="index.php">Continuer sans compte →</a>
                </div>
            </form>
        </div>

        <!-- INSCRIPTION -->
        <div class="form-container sign-up">
            <form method="POST">
                <h2>Inscription</h2>
                <p class="subtitle">Rejoignez la communauté YoonWi</p>

                <?php if ($error): ?>
                    <div class="alert error"><?= htmlspecialchars($error) ?></div>
                <?php endif; ?>

                <input type="text" name="nom" placeholder="Nom complet" required>
                <input type="email" name="email" placeholder="Adresse email" required>
                <input type="password" name="password" placeholder="Mot de passe" required>
                <input type="password" name="confirm" placeholder="Confirmer le mot de passe" required>
                <button type="submit" name="register">S'inscrire</button>

                <div class="guest-link">
                    <a href="index.php">Continuer sans compte →</a>
                </div>
            </form>
        </div>

        <!-- OVERLAY -->
        <div class="overlay">
            <div class="overlay-content">
                <div class="logo">☪</div>
                <h1>YoonWi</h1>
                <p id="overlayText">Une plateforme inspirée des valeurs islamiques et mourides.</p>
                <button class="switch-btn" id="switchBtn">S'inscrire</button>
            </div>
        </div>
    </div>

    <script>
        const container = document.getElementById('container');
        const switchBtn = document.getElementById('switchBtn');
        const overlayTxt = document.getElementById('overlayText');
        let loginMode = true;

        switchBtn.addEventListener('click', () => {
            container.classList.toggle('active');
            if (loginMode) {
                switchBtn.innerText = "Se connecter";
                overlayTxt.innerText = "Déjà membre ? Connectez-vous.";
            } else {
                switchBtn.innerText = "S'inscrire";
                overlayTxt.innerText = "Une plateforme inspirée des valeurs islamiques et mourides.";
            }
            loginMode = !loginMode;
        });
    </script>
</body>

</html>