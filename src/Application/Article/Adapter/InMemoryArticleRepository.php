<?php

namespace Application\Article\Adapter;

use Domain\Article\Entity\Article;
use Domain\Article\Port\ArticleRepositoryInterface;
use Domain\Article\ValueObject\ArticleId;

/**
 * Classe InMemoryArticleRepository
 *
 *  Implémente l'interface ArticleRepositoryInterface pour fournir une
 *  gestion d'articles en mémoire. Cette classe stocke, récupère, met à jour
 *  et supprime des articles à l'aide d'un tableau associatif, ce qui permet
 *  une manipulation des données sans nécessiter de base de données.
 *
 *  Méthodes disponibles :
 *  - find(ArticleId $articleId): Article
 *    Récupère un article par son identifiant.
 *
 *  - save(Article $article): void
 *    Ajoute un nouvel article à la collection.
 *
 *  - update(Article $article): void
 *    Met à jour un article existant dans la collection.
 *
 *  - delete(ArticleId $id): void
 *    Supprime un article de la collection par son identifiant.
 *
 *  - all(): array
 *    Retourne tous les articles stockés dans la collection.
 */
class InMemoryArticleRepository implements ArticleRepositoryInterface
{

    /**
     * Stocke une collection d'articles en mémoire.
     *
     * @var Article[]
     *
     */
    private array $collection = [];

    public function find(ArticleId $articleId): Article
    {
        return $this->collection[$articleId->value];
    }

    public function save(Article $article): void
    {
        $this->collection[$article->id->value] = $article;
    }

    public function update(Article $article): void
    {
        $this->collection[$article->id->value] = $article;
    }

    public function delete(ArticleId $id): void
    {
        unset($this->collection[$id->value]);
    }

    public function all(): array
    {
        return array_values($this->collection);
    }

}