<?php
session_start();
use App\Entity\User;
use Doctrine\ORM\EntityManager;

require_once "../vendor/autoload.php";
$entityManager = require __DIR__ . "/../config/bootstrap.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Rechercher l'utilisateur dans la base de données
    $user = $entityManager->getRepository(User::class)->findOneBy(['email' => $email]);

    if ($user && password_verify($password, $user->getPassword())) {
        // Stocker les informations utilisateur dans la session
        $_SESSION['user'] = [
            'pseudo' => $user->getPseudo(),
            'email' => $user->getEmail()
        ];

        // Rediriger vers la page d'accueil
        header("Location: index.php");
        exit;
    } else {
        $error = "Email ou mot de passe incorrect.";
    }
}
?>

    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Connexion</title>
    </head>
    <body>

    <h1>Connexion</h1>
    <?php if (!empty($error)): ?>
        <p style="color:red"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>
    <form method="post">
        <label>Email : <input type="email" name="email" required></label><br>
        <label>Mot de passe : <input type="password" name="password" required></label><br>
        <button type="submit">Se connecter</button>
    </form>

    </body>
    </html>
