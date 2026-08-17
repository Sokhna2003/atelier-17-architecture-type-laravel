<?php
declare(strict_types=1);

use App\Controllers\BookController;
use App\Controllers\HomeController;

$router->add('GET', '/', [HomeController::class, 'index']);
$router->add('GET', '/books', [BookController::class, 'index']);
