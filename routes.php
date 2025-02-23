<?php
return [
    // basic user management
    '/' => ['view' => './views/release/articles.php', 'requiresAuth' => false],
    '/login' => ['view' => './views/userManagement/login.php', 'requiresAuth' => false],
    '/logout' => ['view' => './views/userManagement/logout.php', 'requiresAuth' => true],
    '/dashboard' => ['view' => './views/userManagement/dashboard.php', 'requiresAuth' => true, 'requiredPermission' => 100],
    '/admin' => ['view' => './views/userManagement/admin.php', 'requiresAuth' => true, 'requiredPermission' => 1],
    '/forbidden' => ['view' => './views/forbidden.php', 'requiresAuth' => false],

    // gestion d'articles de journaux
    '/articles' => ['view' => './views/release/articles.php', 'requiresAuth' => false],
    '/articles/view' => ['view' => './views/release/view_article.php', 'requiresAuth' => false],
    '/articles/search' => ['view' => './views/release/search_articles.php', 'requiresAuth' => false],
    '/articles/add' => ['view' => './views/release/add_article.php', 'requiresAuth' => true, 'requiredPermission' => 100],
    '/articles/edit' => ['view' => './views/release/edit_article.php', 'requiresAuth' => true, 'requiredPermission' => 100],
    '/articles/delete' => ['view' => './views/release/delete_article.php', 'requiresAuth' => true, 'requiredPermission' => 100],

    // gestion des commentaires
    '/comments' => ['view' => './views/comment/comments.php', 'requiresAuth' => false],
    '/comments/delete' => ['view' => './views/comment/delete_comment.php', 'requiresAuth' => true, 'requiredPermission' => 100],
    '/comments/edit' => ['view' => './views/comment/edit_comment.php', 'requiresAuth' => true, 'requiredPermission' => 100],
    '/comments/add' => ['view' => './views/comment/add_comment.php', 'requiresAuth' => true, 'requiredPermission' => 100],
    '/comments/view' => ['view' => './views/comment/view_comment.php', 'requiresAuth' => false],
    '/comments/search' => ['view' => './views/comment/search_comments.php', 'requiresAuth' => false],

];