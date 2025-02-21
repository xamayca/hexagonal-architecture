<?php

namespace App\Article\Domain\Entity;

use App\Article\Domain\ValueObject\ArticleId;

class Article
{
    /**
     * Article constructor.
     * @param ArticleId $id
     * @param string $title
     * Cette classe représente un article dans le domaine de l'application.
     * * Elle contient les propriétés suivantes :
     * * - $id : l'identifiant de l'article (ArticleId)
     * * - $title : le titre de l'article
     */
    public function __construct(

        private(set) ArticleId $id{
            set => $this->id = $value;
            get => $this->id;
        },

        private(set) string $title {
            get => $this->title;
            set => $this->title = $value;
        },

    ){}

}