<?php

declare(strict_types=1);

namespace App\Blog\Domain\Model\Article;

use App\Blog\Domain\Exception\ContentCannotBeEmptyException;
use App\Blog\Domain\Service\SanitizeContentInterface;

class Content
{
    private string $value;

    /**
     * @throws ContentCannotBeEmptyException
     */
    public function __construct(string $content, SanitizeContentInterface $sanitizeContent)
    {
        if (empty($content)) {
            throw new ContentCannotBeEmptyException();
        }

        $this->value = $sanitizeContent->sanitize($content);
    }

    public function value(): string
    {
        return $this->value;
    }
}
