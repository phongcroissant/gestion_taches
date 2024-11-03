<?php
use App\UserStory\CreateAccount;
use Doctrine\ORM\EntityManager;

require_once "../vendor/autoload.php";
$entityManager = require __DIR__ . "/../config/bootstrap.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $pseudo = $_POST['pseudo'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        $createAccount = new CreateAccount($entityManager);
        $user = $createAccount->execute($pseudo, $email, $password);

        // Redirige vers la page de connexion après création du compte
        header("Location: views/login.php");
        exit;
    } catch (\Exception $e) {
        $error = $e->getMessage();
    }
}
?>

    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Créer un compte</title>
    </head>
    <body>

    <h1>Créer un compte</h1>
    <?php if (!empty($error)): ?>
        <p style="color:red"><?= $error ?></p>
    <?php endif; ?>
    <form method="post">
        <label>Pseudo : <input type="text" name="pseudo" required></label><br>
        <label>Email : <input type="email" name="email" required></label><br>
        <label>Mot de passe : <input type="password" name="password" required></label><br>
        <button type="submit">Créer un compte</button>
    </form>

    </body>
    </html>

