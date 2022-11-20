<?php

declare(strict_types=1);

namespace App\Blog\Infrastructure\Service\Content\Sanitize;

use App\Blog\Domain\Service\SanitizeContentInterface;

class SanitizeContent implements SanitizeContentInterface
{
    public function sanitize(string $content): string
    {
        /* @todo remove javascript code from content */
        return $content;
    }
}
