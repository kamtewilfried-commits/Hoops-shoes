<?php
session_start(); 

// Déterminer le contrôleur et l'action depuis l'URL 
$controller = $_GET['controller'] ?? 'home';
$action = $_GET['action'] ?? 'index';

// Définir les routes accessibles sans être connecté
$autoriseSansConnexion = [
    ['controller' => 'utilisateur', 'action' => 'connexion'],
    ['controller' => 'utilisateur', 'action' => 'index'], 
];

// Vérifier si l'utilisateur est connecté
$estConnecte = isset($_SESSION['utilisateur']);

// Vérifier si la route demandée est publique
$estAutorise = false;
foreach ($autoriseSansConnexion as $autorise) {
    if ($controller === $autorise['controller'] && $action === $autorise['action']) {
        $estAutorise = true;
        break;
    }
}

// Si l'utilisateur n'est pas connecté et la route est refusé
if (!$estConnecte && !$estAutorise) {
    header('Location: index.php?controller=utilisateur&action=connexion');
    exit;
}

// Génération du nom du contrôleur à partir du paramètre
$controllerName = ucfirst($controller) . 'Controller';
$controllerFile = "app/controllers/$controllerName.php";

// Vérification de l'existence du fichier contrôleur
if (file_exists($controllerFile)) {
    require_once $controllerFile;

    // Instanciation du contrôleur
    $ctrl = new $controllerName();

    // Vérification de l'existence de la méthode (action)
    if (method_exists($ctrl, $action)) {
        $ctrl->$action();
    } else {
        echo "Action '$action' non trouvée dans le contrôleur '$controllerName'.";
    }
} else {
    echo "Contrôleur '$controllerName' non trouvé.";
}
