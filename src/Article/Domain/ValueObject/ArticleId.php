<?php

namespace App\Article\Domain\ValueObject;

use App\Article\Domain\Exception\NegativeArticleIdException;

readonly class ArticleId
{

    /**
     * ArticleId constructor.
     * @param int|string $value
     * Cette classe représente l'identifiant d'un post dans le domaine.
     * * Elle est immuable et ne peut être modifiée une fois instanciée.
     * * Le type string est utilisé pour l'identifiant afin de permettre une flexibilité maximale (int, string, uuid, etc.).
     * * La propriété $value contient la valeur de l'identifiant du post, passée lors de l'instanciation de la classe.
     * @throws NegativeArticleIdException
     */
    public function __construct(

        public int|string $value

    )
    {

        if (is_int($this->value) && $this->value < 0) {
            throw new NegativeArticleIdException($this->value);
        }

    }

}