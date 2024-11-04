<?php

namespace App\UserStory;

use Doctrine\ORM\EntityManager;

class Login
{
    private EntityManager $entityManager;
    public function __construct(EntityManager $entityManager)
    {
        // L'EntityManager est injecté par dépendance
        $this->entityManager = $entityManager;
    }
}