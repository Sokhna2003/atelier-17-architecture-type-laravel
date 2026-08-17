<?php
declare(strict_types=1);

namespace App\Repositories;

// L'implémentation concrète : accès aux données via PDO.
class BookRepository implements BookRepositoryInterface
{
    public function __construct(private \PDO $pdo) {}

    public function findAll(): array
    {
        $stmt = $this->pdo->query(
            'SELECT b.*, c.libelle AS categorie FROM books b LEFT JOIN categories c ON c.id = b.categorie_id ORDER BY b.titre'
        );
        return $stmt->fetchAll();
    }
}
