<?php

declare(strict_types=1);

namespace UI\Admin\Controller\Dashboard;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use UI\Admin\Controller\AbstractAdminController;

class DashboardController extends AbstractAdminController
{
    #[Route('/dashboard', name: 'dashboard')]
    public function dashboard(): Response
    {
        return $this->render('admin/dashboard.html.twig');
    }
}

