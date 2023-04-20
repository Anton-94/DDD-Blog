<?php

declare(strict_types=1);

namespace UI\Admin\Controller\User;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use UI\Admin\Controller\AbstractAdminController;
use UI\Admin\Input\User\SignInInput;
use UI\Admin\Form\User\SignInType;

#[Route('/admin', name: 'admin_')]
class SignInController extends AbstractAdminController
{
    #[Route("/sign-in", name: 'sign_in')]
    public function signIn(Request $request, AuthenticationUtils $authenticationUtils): Response
    {
        if ($this->getUser()) {
            return $this->redirectToRoute('admin_dashboard');
        }

        $form = $this->createForm(SignInType::class, null, [
            'last_email' => $authenticationUtils->getLastUsername()
        ]);
        $form->handleRequest($request);

        return $this->render('admin/user/sign_in.html.twig', [
            'form' => $form->createView(),
            'lastAuthenticationError' => $authenticationUtils->getLastAuthenticationError(),
        ]);
    }
}

