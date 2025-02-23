<?php
session_start();
require_once 'bootstrap.php'; // Initialisation des dépendances

// Initialisation du contrôleur
$authController = new AuthController();

// Liste des routes
$routes = require_once 'routes.php';

// Identifier la route demandée
$requestUri = strtok($_SERVER['REQUEST_URI'], '?'); // Supprime les paramètres GET
$matchedRoute = $routes[$requestUri] ?? null;

// Gestion de la route inexistante
if (!$matchedRoute) {
    http_response_code(404);
    echo "Page non trouvée. $requestUri";
    exit;
}

// Vérification de l'authentification, si nécessaire
if ($matchedRoute['requiresAuth'] ?? false) {
    // Vérifier si l'utilisateur est connecté
    if (!isset($_SESSION['user'])) {
        header('Location: /');
        exit;
    }

    // Vérifier les permissions requises
    $requiredPermission = $matchedRoute['requiredPermission'] ?? 0;
    if (!$authController->checkPermission($requiredPermission)) {
        header('Location: /forbidden');
        exit;
    }
}


// Inclusion de la vue de la route correspondante

require_once $matchedRoute['view'];