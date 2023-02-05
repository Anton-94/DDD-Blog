<?php

declare(strict_types=1);

namespace UI\Http\Rest\Input\Blog\Article;

use Symfony\Component\Validator\Constraints as Assert;
use UI\Http\Rest\Input\Shared\InputInterface;

class DraftInput implements InputInterface
{
    public function __construct(
        #[Assert\NotBlank]
        public readonly string $title,
        #[Assert\NotBlank]
        public readonly string $content
    ) {
    }
}

