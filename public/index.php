<?php
session_start();

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Accueil</title>
</head>
<body>

<header>
    <nav>
        <ul>
            <li><a href="index.php">Accueil</a></li>
            <?php if (isset($_SESSION['user'])): ?>
                <li><a href="/views/logout.php">Se déconnecter</a></li>
                <li>Vous êtes connecté en tant que <?= htmlspecialchars($_SESSION['user']['pseudo']) ?></li>
            <?php else: ?>
                <li><a href="/views/formulaireCreateAccount.php">Créer un compte</a></li>
                <li><a href="/views/login.php">Se connecter</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>

<main>
    <h1>Bienvenue sur la page d'accueil</h1>
</main>

</body>
</html>
