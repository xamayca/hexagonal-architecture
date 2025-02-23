<?php

namespace App\Tests\Unit;

use App\Article\Application\Repository\InMemoryArticleRepository;
use App\Article\Domain\Entity\Article;
use App\Article\Domain\Exception\NegativeArticleIdException;
use App\Article\Domain\ValueObject\ArticleId;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(Article::class)]
class InMemoryArticleRepositoryTest extends TestCase
{
    private InMemoryArticleRepository $repository;
    private Article $article;
    private ArticleId $articleId;

    /**
     * Configuration pour chaque test
     * @throws NegativeArticleIdException
     */
    protected function setUp(): void
    {
        $this->repository = new InMemoryArticleRepository();
        $this->articleId = new ArticleId(value: 1);
        $this->article = new Article(id: $this->articleId, title: 'InMemory Article Test');
    }

    public function test_add_article_to_in_memory_repository(): void
    {
        $this->repository->add($this->article);
        $entity = $this->repository->get($this->articleId);

        $this->assertInstanceOf(Article::class, $entity);
        $this->assertSame($this->articleId, $entity->id);
        $this->assertSame($this->article->title, $entity->title);
    }

    /**
     * @throws NegativeArticleIdException
     */
    public function test_get_article_by_id_in_memory_repository(): void
    {
        $article2Id = new ArticleId(value: 2);
        $article2 = new Article(id: $article2Id, title: 'Second InMemory Article Test');

        $this->repository->add($this->article);
        $this->repository->add($article2);

        $article1 = $this->repository->get($this->articleId);
        $article2 = $this->repository->get($article2Id);

        $this->assertInstanceOf(Article::class, $article1);
        $this->assertSame($this->articleId, $article1->id);
        $this->assertSame($this->article->title, $article1->title);

        $this->assertInstanceOf(Article::class, $article2);
        $this->assertSame($article2Id, $article2->id);
        $this->assertSame($article2->title, $article2->title);

        $this->assertNotSame($article1, $article2);
    }

    public function test_update_article_in_memory_repository(): void
    {
        $this->repository->add($this->article);

        $updatedArticle = new Article(id: $this->articleId, title: 'New InMemory Article Test');
        $this->repository->update($updatedArticle);

        $entity = $this->repository->get($this->articleId);

        $this->assertInstanceOf(Article::class, $entity);
        $this->assertSame('New InMemory Article Test', $entity->title);
        $this->assertNotSame($this->article->title, $entity->title);
    }

    /**
     * @throws NegativeArticleIdException
     */
    public function test_get_all_article_in_memory_repository(): void
    {
        $article2Id = new ArticleId(value: 2);
        $article2 = new Article(id: $article2Id, title: 'Second InMemory Article Test');

        $this->repository->add($this->article);
        $this->repository->add($article2);

        $collection = $this->repository->all();

        $this->assertCount(2, $collection);
    }

    public function test_delete_article_by_id_in_memory_repository(): void
    {
        $this->repository->add($this->article);
        $this->repository->delete($this->article->id);

        $collection = $this->repository->all();

        $this->assertCount(0, $collection);
    }

}
