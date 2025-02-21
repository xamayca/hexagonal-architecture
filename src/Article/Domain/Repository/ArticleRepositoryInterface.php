<?php


namespace App\Article\Domain\Repository;

use App\Article\Domain\Entity\Article;
use App\Article\Domain\ValueObject\ArticleId;

/**
 * Interface ArticleRepositoryInterface
 * @package App\Article\Domain\Repository
 * Cette interface représente le contrat que doit respecter un repository de post.
 * * Elle contient les méthodes suivantes :
 * * - add (Article $post) : ajoute un post
 * * - update (Article $post) : met à jour un post
 * * - remove (ArticleId $id) : supprime un post
 * * - get (ArticleId $id) : récupère un post par son identifiant
 * * - all() : récupère tous les posts
 * * - generateId() : génère un identifiant de post (en général, un UUID ou un entier auto-incrémenté)
 */
interface ArticleRepositoryInterface
{
    /**
     * Ajoute un article
     * @param Article $article
     */
    public function add(Article $article): void;

    /**
     * Récupère un article
     * @param ArticleId $articleId
     * @return Article|null
 */
    public function get(ArticleId $articleId): ?Article;

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

    /**
     * Génère un identifiant de post (en général, un UUID, un Ulid ou un entier auto-incrémenté)
     * @return ArticleId
     */
    public function generateId(): ArticleId;
}