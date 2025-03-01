<?php

namespace Domain\Article\Entity;

use Domain\Article\ValueObject\ArticleId;

class Article
{
    /**
     * Classe Article.
     *
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