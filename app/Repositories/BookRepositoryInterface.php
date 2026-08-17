<?php
declare(strict_types=1);

namespace App\Repositories;

// Un contrat : n'importe quelle classe qui l'implémente DOIT avoir une méthode findAll().
// Ça permet au BookController de ne jamais dépendre d'une classe concrète,
// seulement de ce contrat -> on pourrait remplacer BookRepository par autre chose
// (ex: une version qui lit un fichier JSON) sans toucher au contrôleur

interface BookRepositoryInterface
{
    public function findAll(): array;
}
