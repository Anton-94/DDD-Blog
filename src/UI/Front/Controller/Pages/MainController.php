<?php

declare(strict_types=1);

namespace UI\Front\Controller\Pages;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use UI\Front\Controller\AbstractFrontController;

class MainController extends AbstractFrontController
{
    #[Route("/", name: 'main')]
    public function __invoke(): Response
    {
        return $this->render('front/pages/main.html.twig');
    }
}

