<?php

namespace App\Blog\Domain\Enum\Article;

enum StatusEnum: string
{
    case DRAFT = 'DRAFT';
    case PUBLISHED = 'PUBLISHED';
    case ARCHIVED = 'ARCHIVED';
}

