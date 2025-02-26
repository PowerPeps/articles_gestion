<?php

global $authController, $routes;


$loggedIn = isset($_SESSION['user']);

$userPermission = $authController->getPermissions() ?? constant('GUEST_LEVEL');

echo '<div class="menu">';
foreach ($routes as $path => $route) {
    $requiresAuth = $route['requiresAuth'] ?? false;

    $sufficientPermission = isset($route['requiredPermission']) && ($route['requiredPermission'] >= $userPermission);
    $temp = false;

    if (isset($route['displayName'])) {
        if (($requiresAuth && $loggedIn && $sufficientPermission) || !$requiresAuth ) {
            $temp = true;
        }
    }


    if ($temp) {
        $displayName = htmlspecialchars($route['displayName']);
        echo '<div><a href="' . htmlspecialchars($path) . '">' . $displayName . '</a></div>';
    }
}
echo '</div>';
?>

<style>
    .menu {
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
        align-items: center;
        justify-content: flex-start;
        gap: 10px;
    }

    .menu div {
        border: 1px solid #d1b077;
    }