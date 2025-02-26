<?php

namespace App\Tests\Unit;

use Domain\Article\Exception\EmptyArticleIdException;
use Domain\Article\Exception\InvalidArticleIdException;
use Domain\Article\ValueObject\ArticleId;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

#[CoversClass(ArticleId::class)]
class ArticleIdTest extends TestCase
{
    /**
     * Fournit des cas d'utilisation pour tester le Value Object ArticleId.
     *
     * Chaque cas teste la création d'un ArticleId avec différents types de valeurs :
     * - Entier
     * - Hash SHA-256
     * - Hash SHA-512
     * - UUID
     *
     * Et vérifie que la valeur stockée correspond à la valeur attendue.
     *
     * @return array<string, array{ id: int|string, expected: int|string }>
     *
     */
    public static function dataProviderArticleId(): array
    {
        return [
            'int 1 value' => [
                'id' => 1,
                'expected' => 1,
            ],
            'hash 256 value' => [
                'id' => $hash256 = hash('sha256', 'Hashed 256 Article ID'),
                'expected' => $hash256,
            ],
            'hash 512 value' => [
                'id' => $hash512 = hash('sha512', 'Hashed 512 Article ID'),
                'expected' => $hash512,
            ],
            'uniqid value' => [
                'id' => $uuid = uniqid(),
                'expected' => $uuid,
            ],
        ];
    }

    /**
     * @throws InvalidArticleIdException
     * @throws EmptyArticleIdException
     */
    #[DataProvider('dataProviderArticleId')]
    public function test_article_id_value_object_created(int|string $id, int|string $expected): void
    {
        $articleId = new ArticleId(value: $id);
        $this->assertSame($expected, $articleId->value, "The value stored in ArticleId should match the expected value.");
    }

    /**
     * @throws EmptyArticleIdException
     */
    public function test_article_id_value_object_created_with_empty_string_throws_exception(): void
    {
        $this->expectException(EmptyArticleIdException::class);
        $this->expectExceptionMessage('Invalid value "" provided for "ArticleId". The value cannot be empty.');

        new ArticleId(value: '');
    }

    /**
     * @throws InvalidArticleIdException
     * @throws EmptyArticleIdException
     */
    public function test_article_id_value_object_created_with_negative_int_value_throws_exception(): void
    {
        $this->expectException(InvalidArticleIdException::class);
        $this->expectExceptionMessage('Invalid value "-1" provided for "ArticleId". The value cannot be negative or zero.');

        new ArticleId(value: -1);
    }

}