<?php

namespace App\UserStory;
use App\Entity\User;
use Doctrine\ORM\EntityManager;

class CreateAccount
{
    private EntityManager $entityManager;

    /**
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        // L'EntityManager est injecté par dépendance
        $this->entityManager = $entityManager;
    }
    // Cette méthode permettra  d'exécuter la user story
    public function execute(string $pseudo,string $email, string $password): User {
        // Vérifier que les données sont présentes
        // Si tel n'est pas le cas, lancer une exception
        if (empty($pseudo) || empty($email) || empty($password)) {
            throw new \Exception("Veuillez remplir les champs");
        }
        // Vérifier si l'email est valide
        // Si tel n'est pas le cas, lancer une exception
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new \Exception("Veuillez saisir une adresse mail valide");
        }
        // Vérifier si le pseudo est entre 2 et 50 caractère
        // Si tel n'est pas le cas, lancer une exception
        if (strlen($password) < 2||strlen($password) > 50) {
            throw new \Exception("Veuillez saisir un pseudo entre 2 et 50 caractères");
        }
        // Vérifier si le mot de passe est sécurisé
        // Si tel n'est pas le cas, lancer une exception
        // Vérifier l'unicité de l'email
        $dql="SELECT p.email FROM App\Entity\User p";
        $query=$this->entityManager->createQuery($dql);
        $emailBDDs=$query->getScalarResult();
        foreach ($emailBDDs as $emailBDD) {
            if ($emailBDD==$email) {
                throw new \Exception("L'adresse mail existe déjà !");
            }
        }
        // Si tel n'est pas le cas, lancer une exception

        // Insérer les données dans la base de données
        // 1. Hasher le mot de passer

        // 2. Créer une instance de la classe User avec l'email, le pseudo et le mot de passe hashé
        $user=new User();
        // 3. Persister l'instance en utilisant l'EntityManager
        $this->entityManager->persist($user);

        $this->entityManager->flush();

        // Envoie un mail de confirmation
        echo "Un email de confirmation a été envoyé à l'utilisateur.";
        return $user;
    }

}