<?php

declare(strict_types=1);

namespace UI\Admin\Controller\Blog\Article;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use UI\Admin\Controller\AbstractAdminController;

class ArticleListingController extends AbstractAdminController
{
    #[Route("/articles", name: 'articles')]
    public function __invoke(): Response
    {

    }
}

