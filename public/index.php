<?php
session_start(); // Démarre la session

$entityManager=require_once __DIR__. '/../config/bootstrap.php'; // Charge l'EntityManager


// Logique de routage
$controller = $_GET['controller'] ?? 'inscription';
$action = $_GET['action'] ?? 'index';

// Création d'une instance du contrôleur approprié
switch ($controller) {
    case 'inscription':
        $instance = new App\UserStory\CreateAccount($entityManager);
        break;
    case 'Login':
        $instance = new App\UserStory\Login($entityManager);
        break;
}

// Vérifiez si l'utilisateur est connecté
$user = null;
if (isset($_SESSION['user_id'])) {
    $user = $entityManager->getRepository(App\Entity\User::class)->find($_SESSION['user_id']);
}

// Appel de la méthode d'action appropriée
$instance->{$action}();

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
                <li>Vous êtes connecté en tant que <?= ($_SESSION['user']['pseudo']) ?></li>
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
