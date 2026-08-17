<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Repositories\BookRepositoryInterface;
use Core\View;

// Le constructeur demande une BookRepositoryInterface, pas un BookRepository.
// C'est le Container qui décide QUELLE implémentation concrète fournir
// (défini dans public/index.php : bind(BookRepositoryInterface::class, ...))

class BookController
{
    public function __construct(private BookRepositoryInterface $repository) {}

    public function index(): string
    {
        $livres = $this->repository->findAll();
        return View::render('books', ['livres' => $livres]);
    }
}
