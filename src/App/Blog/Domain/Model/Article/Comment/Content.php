<?php

declare(strict_types=1);

namespace App\Blog\Domain\Model\Article\Comment;

use App\Blog\Domain\Exception\ContentCannotBeEmptyException;

class Content
{
    private string $value;

    /**
     * @throws ContentCannotBeEmptyException
     */
    public function __construct(string $content)
    {
        if (empty($content)) {
            throw new ContentCannotBeEmptyException();
        }

        $this->value = $content;
    }

    public function value(): string
    {
        return $this->value;
    }
}

