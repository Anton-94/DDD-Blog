<?php

declare(strict_types=1);

namespace App\Blog\Domain\Service;

interface SanitizeContentInterface
{
    public function sanitize(string $content): string;
}
