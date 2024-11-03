<?php
session_start();
session_unset();
session_destroy();

// Redirige vers la page d'accueil
header("Location: public/index.php");
exit;

