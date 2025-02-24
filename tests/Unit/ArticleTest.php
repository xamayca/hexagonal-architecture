<?php

namespace App\Tests\Unit;

use App\Article\Domain\Entity\Article;
use App\Article\Domain\Exception\EmptyArticleIdException;
use App\Article\Domain\Exception\InvalidArticleIdException;
use App\Article\Domain\ValueObject\ArticleId;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(Article::class)]
class ArticleTest extends TestCase
{
    /**
     * @throws InvalidArticleIdException
     * @throws EmptyArticleIdException
     */
    public function test_create_article_with_int_id(): void
    {
        $articleId = new ArticleId(value: 1);
        $article = new Article(id: $articleId, title: 'Test Article');

        $this->assertEquals(1, $article->id->value);
        $this->assertEquals('Test Article', $article->title);
    }
}