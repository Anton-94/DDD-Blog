<?php

declare(strict_types=1);

namespace App\Blog\Domain\Model\Article;

use App\Blog\Domain\Exception\NameCannotBeEmptyException;

class Name
{
    private string $value;

    /**
     * @throws NameCannotBeEmptyException
     */
    public function __construct(string $name)
    {
        if (empty($name)) {
            throw new NameCannotBeEmptyException();
        }

        $this->value = $name;
    }

    public function value(): string
    {
        return $this->value;
    }
}
