<?php

namespace App\Tests\Unit;

use Domain\Article\Entity\Article;
use Domain\Article\Exception\EmptyArticleIdException;
use Domain\Article\Exception\InvalidArticleIdException;
use Domain\Article\ValueObject\ArticleId;
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