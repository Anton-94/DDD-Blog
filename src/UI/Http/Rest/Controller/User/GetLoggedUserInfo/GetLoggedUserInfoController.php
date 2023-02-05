<?php

declare(strict_types=1);

namespace UI\Http\Rest\Controller\User\GetLoggedUserInfo;

use App\User\Application\Fetcher\UserFetcher;
use App\User\Infrastructure\Security\Symfony\AuthenticatedSymfonyUser;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class GetLoggedUserInfoController extends AbstractController
{
    public function __construct(
        private readonly UserFetcher $userFetcher
    ) {
    }

    #[Route('/api/user/me')]
    public function getInfo(): JsonResponse
    {
        /** @var AuthenticatedSymfonyUser $user */
        $user = $this->getUser();
        $userDto = $this->userFetcher->findByUuid($user->uuid());

        return new JsonResponse([
            'uuid' => $userDto->uuid->value(),
            'email' => $userDto->email->value(),
            'roles' => $userDto->roles,
        ]);
    }
}
