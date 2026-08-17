<?php
declare(strict_types=1);

namespace App\Controllers;

use Core\View;

class HomeController
{
    public function index(): string
    {
        // Le contrôleur ne fait JAMAIS de HTML lui-même.
        // Il appelle View::render() en lui passant le nom du template
        // et les données à injecter dedans
        return View::render('home', ['titre' => 'Bienvenue à la bibliothèque']);
    }

    public function about(): string
    {
        return View::render('about', ['message' => 'Mini-application type Laravel']);
    }

}
