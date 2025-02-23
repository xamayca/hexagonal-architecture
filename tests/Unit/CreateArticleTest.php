<?php

namespace App\Tests\Unit;

use App\Article\Domain\Entity\Article;
use App\Article\Domain\Exception\NegativeArticleIdException;
use App\Article\Domain\ValueObject\ArticleId;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(Article::class)]
class CreateArticleTest extends TestCase
{
    /**
     * @throws NegativeArticleIdException
     */
    public function test_create_article(): void
    {
        $articleId = new ArticleId(value: 1);
        $article = new Article(id: $articleId, title: 'Test Article');

        $this->assertEquals(1, $article->id->value);
        $this->assertEquals('Test Article', $article->title);
    }
}