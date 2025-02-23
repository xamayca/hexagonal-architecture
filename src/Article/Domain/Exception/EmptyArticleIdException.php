<?php

namespace App\Article\Domain\Exception;

class EmptyArticleIdException extends \Exception
{
    private const int ERROR_CODE = 1001;

    public function __construct(
        int|string $value,
        ?\Throwable $previous = null
    ) {
        $message = sprintf(
            'Invalid value "%s" provided for "ArticleId". The value cannot be empty.',
            $value
        );
        parent::__construct($message, self::ERROR_CODE, $previous);
    }

}
