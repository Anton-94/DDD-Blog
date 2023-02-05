<?php

declare(strict_types=1);

namespace UI\Http\Rest\Controller\User\SignUp;

use App\Shared\Application\Command\CommandBusInterface;
use App\User\Application\Command\SignUp\SignUpCommand;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use UI\Http\Rest\Input\User\SignUpInput;

class SignUpController extends AbstractController
{
    public function __construct(
        private readonly CommandBusInterface $commandBus,
    ) {
    }

    #[Route('/api/sign-up', name: 'sign-up', methods: ['POST'])]
    public function signUp(SignUpInput $signUpInput): Response
    {
        $this->commandBus->dispatch(new SignUpCommand($signUpInput->email, $signUpInput->password));

        return new JsonResponse([], Response::HTTP_CREATED);
    }
}
