<?php

declare(strict_types=1);

namespace App\Blog\Infrastructure\Service\Content\Sanitize;

use App\Blog\Domain\Service\SanitizeContentInterface;

class NotSanitizeContent implements SanitizeContentInterface
{
    public function sanitize(string $content): string
    {
        return $content;
    }
}

