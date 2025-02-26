<?php


namespace Domain\Article\Port;

use Domain\Article\Entity\Article;
use Domain\Article\ValueObject\ArticleId;

/**
 * Interface ArticleRepositoryInterface
 * @package App\Article\Domain\Repository
 * Cette interface représente le contrat que doit respecter un repository de post.
 *  Elle contient les méthodes suivantes :
 *  - save (Article $post) : ajoute un post
 *  - update (Article $post) : met à jour un post
 *  - remove (ArticleId $id) : supprime un post
 *  - find (ArticleId $id) : récupère un post par son identifiant
 *  - all() : récupère tous les posts
 */
interface ArticleRepositoryInterface
{
    /**
     * Ajoute un article
     * @param Article $article
     */
    public function save(Article $article): void;

    /**
     * Récupère un article
     * @param ArticleId $articleId
     * @return Article|null
 */
    public function find(ArticleId $articleId): ?Article;

    /**
     * Met à jour un post
     * @param Article $article
     */
    public function update(Article $article): void;

    /**
     * Supprime un post
     * @param ArticleId $id
     */
    public function delete(ArticleId $id): void;

    /**
     * Récupère tous les posts
     * @return Article[] Un tableau d'objets Article
     */
    public function all(): array;

}