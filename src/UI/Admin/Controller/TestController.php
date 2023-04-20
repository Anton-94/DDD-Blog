<?php

declare(strict_types=1);

namespace UI\Admin\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{
    #[Route('/test')]
    public function test()
    {
        return $this->render('base.html.twig');
    }
}

