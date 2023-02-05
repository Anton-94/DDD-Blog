<?php

declare(strict_types=1);

namespace App\Blog\Domain\Model\Article;

use App\Blog\Domain\Exception\NameCannotBeEmptyException;

class Title
{
    private string $value;

    /**
     * @throws NameCannotBeEmptyException
     */
    public function __construct(string $title)
    {
        if (empty($title)) {
            throw new NameCannotBeEmptyException();
        }

        $this->value = $title;
    }

    public function value(): string
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return $this->value();
    }
}
