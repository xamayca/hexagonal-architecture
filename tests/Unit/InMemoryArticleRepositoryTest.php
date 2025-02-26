<?php

namespace App\Tests\Unit;

use Application\Article\Adapter\InMemoryArticleRepository;
use Domain\Article\Entity\Article;
use Domain\Article\Exception\EmptyArticleIdException;
use Domain\Article\Exception\InvalidArticleIdException;
use Domain\Article\Port\ArticleRepositoryInterface;
use Domain\Article\ValueObject\ArticleId;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

#[CoversClass(InMemoryArticleRepository::class)]
class InMemoryArticleRepositoryTest extends TestCase
{
    private InMemoryArticleRepository $repository;
    private Article $article;
    private ArticleId $articleId;

    /**
     * Configuration exécutée avant chaque test.
     *
     * - Crée une instance de InMemoryArticleRepository.
     * - Crée un nouvel ArticleId avec la valeur "1".
     * - Crée un nouvel Article avec les propriétés suivantes :
     *   - id : ArticleId
     *   - title : "InMemory Article Test"
     *
     * @throws InvalidArticleIdException
     * @throws EmptyArticleIdException
     */
    protected function setUp(): void
    {
        $this->repository = new InMemoryArticleRepository();
        $this->articleId = new ArticleId(value: 1);
        $this->article = new Article(id: $this->articleId, title: 'InMemory Article Test');
    }

    /**
     * Fournit des cas d'utilisation pour tester les méthodes du dépôt d'articles.
     *
     * @return array<string, array{ method: string }>
     */
    public static function dataProviderArticleRepositoryMethodName(): array
    {
        return [
            'method save' => ['method' => 'save'],
            'method find' => ['method' => 'find'],
            'method update' => ['method' => 'update'],
            'method delete' => ['method' => 'delete'],
            'method all' => ['method' => 'all'],
        ];
    }

    #[DataProvider('dataProviderArticleRepositoryMethodName')]
    public function test_in_memory_repository_implements_article_repository_interface(string $method): void
    {
        $this->assertInstanceOf(ArticleRepositoryInterface::class, $this->repository, 'The repository should implement ArticleRepositoryInterface.');
        $this->assertTrue(method_exists($this->repository, $method), "Method '{$method}' does not exist in InMemoryArticleRepository.");
    }

    public function test_in_memory_repository_method_save_article(): void
    {
        $this->repository->save($this->article);
        $entity = $this->repository->find($this->articleId);

        $this->assertInstanceOf(Article::class, $entity, 'The saved article should be an instance of Article.');
        $this->assertSame($this->articleId, $entity->id, 'The article ID should match the expected ID.');
        $this->assertSame($this->article->title, $entity->title, 'The article title should match the expected title.');
    }

    /**
     * @throws InvalidArticleIdException
     * @throws EmptyArticleIdException
     */
    public function test_in_memory_repository_method_get_article_by_id(): void
    {
        $article2Id = new ArticleId(value: 2);
        $article2 = new Article(id: $article2Id, title: 'Second InMemory Article Test');

        $this->repository->save($this->article);
        $this->repository->save($article2);

        $article1 = $this->repository->find($this->articleId);
        $article2 = $this->repository->find($article2Id);

        $this->assertInstanceOf(Article::class, $article1, 'The first retrieved article should be an instance of Article.');
        $this->assertSame($this->articleId, $article1->id, 'The ID of the first article should match the expected ID.');
        $this->assertSame($this->article->title, $article1->title, 'The title of the first article should match the expected title.');

        $this->assertInstanceOf(Article::class, $article2, 'The second retrieved article should be an instance of Article.');
        $this->assertSame($article2Id, $article2->id, 'The ID of the second article should match the expected ID.');
        $this->assertSame($article2->title, $article2->title, 'The title of the second article should match the expected title.');

        $this->assertNotSame($article1, $article2, 'The two articles should not be the same instance.');
        $this->assertNotSame($article1->title, $article2->title, 'The titles of the two articles should not be the same.');
    }

    public function test_in_memory_repository_method_update_article(): void
    {
        $this->repository->save($this->article);

        $updatedArticle = new Article(id: $this->articleId, title: 'New InMemory Article Test');

        $this->repository->update($updatedArticle);

        $entity = $this->repository->find($this->articleId);

        $this->assertInstanceOf(Article::class, $entity, 'The updated article should be an instance of Article.');
        $this->assertSame($updatedArticle->title, $entity->title, 'The title of the updated article should match the new title.');
        $this->assertNotSame($this->article->title, $entity->title, 'The title of the updated article should not be the same as the original title.');
    }

    /**
     * @throws InvalidArticleIdException
     * @throws EmptyArticleIdException
     */
    public function test_in_memory_repository_method_get_all_article(): void
    {
        $article2Id = new ArticleId(value: 2);
        $article2 = new Article(id: $article2Id, title: 'Second InMemory Article Test');

        $this->repository->save($this->article);
        $this->repository->save($article2);

        $collection = $this->repository->all();

        $this->assertCount(2, $collection, 'The collection should contain exactly 2 articles.');
    }

    public function test_in_memory_repository_method_delete_article_by_id(): void
    {
        $this->repository->save($this->article);
        $this->repository->delete($this->article->id);

        $collection = $this->repository->all();

        $this->assertCount(0, $collection, 'The collection should be empty after deleting the article.');
    }

}