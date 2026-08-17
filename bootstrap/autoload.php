<?php
declare(strict_types=1);

// Enregistre un autoloader : quand on utilise "new App\Controllers\BookController()",
// PHP appelle automatiquement cette fonction pour trouver et charger le bon fichier,
// sans qu'on ait besoin de faire des require partout

spl_autoload_register(function (string $classe): void {
    $prefixes = [
        'App\\' => __DIR__ . '/../app/',  // App\Controllers\X -> app/Controllers/X.php
        'Core\\' => __DIR__ . '/../core/',  // Core\Router -> core/Router.php
    ];

    foreach ($prefixes as $prefixe => $base) {
        if (str_starts_with($classe, $prefixe)) {
            $chemin = $base . str_replace('\\', '/', substr($classe, strlen($prefixe))) . '.php';
            if (file_exists($chemin)) {
                require $chemin;
                return;
            }
        }
    }
});

require_once __DIR__ . '/../core/View.php';
require_once __DIR__ . '/../config/database.php';

if (!defined('VIEW_PATH')) {
    define('VIEW_PATH', __DIR__ . '/../views');
}
