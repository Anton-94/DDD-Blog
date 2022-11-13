<?php

declare(strict_types=1);

namespace UI\Http\Rest\Controller\SignUp;

use App\Shared\Application\Command\CommandBusInterface;
use App\User\Application\Command\SignUp\SignUpCommand;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SignUpController extends AbstractController
{
    public function __construct(
        private readonly CommandBusInterface $commandBus,
    ) {
    }

    #[Route('/api/sign-up', name: 'sign-up', methods: ['POST'])]
    public function signUp(Request $request): Response
    {
        $email = (string) $request->toArray()['email'];
        $password = (string) $request->toArray()['password'];

        $this->commandBus->dispatch(new SignUpCommand($email, $password));

        return new JsonResponse();
    }
}
