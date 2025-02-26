<?php

namespace Domain\Article\ValueObject;

use Domain\Article\Exception\EmptyArticleIdException;
use Domain\Article\Exception\InvalidArticleIdException;

readonly class ArticleId
{

    /**
     * Classe ArticleId.
     * @param int|string $value
     * Cette classe représente l'identifiant d'un post dans le domaine.
     * * Elle est immuable et ne peut être modifiée une fois instanciée.
     * * Le type int|string est utilisé pour l'identifiant afin de permettre une flexibilité maximale (int, string, uuid, etc.).
     * * La propriété $value contient la valeur de l'identifiant du post, passée lors de l'instanciation de la classe.
     * @throws InvalidArticleIdException
     * @throws EmptyArticleIdException
     */
    public function __construct(

        private(set) int|string $value

    )
    {

        if ($this->value === '') {
            throw new EmptyArticleIdException($this->value);
        }

        if (is_int($this->value) && $this->value < 1) {
            throw new InvalidArticleIdException($this->value);
        }

    }

}