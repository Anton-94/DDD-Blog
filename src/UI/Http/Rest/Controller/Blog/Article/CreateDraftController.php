<?php

declare(strict_types=1);

namespace UI\Http\Rest\Controller\Blog\Article;

use App\Blog\Application\Command\Article\CreateDraft\CreateDraftCommand;
use App\Blog\Domain\Model\Author\AuthorId;
use App\Shared\Application\Command\CommandBusInterface;
use App\User\Application\Fetcher\UserFetcher;
use App\User\Infrastructure\Security\Symfony\AuthenticatedSymfonyUser;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use UI\Http\Rest\Input\Blog\Article\DraftInput;

class CreateDraftController extends AbstractController
{
    public function __construct(
        private readonly CommandBusInterface $commandBus,
        private readonly UserFetcher $userFetcher
    ) {
    }

    #[Route('/api/draft/create', name: 'create-draft', methods: ['POST'])]
    public function signUp(DraftInput $draftInput): Response
    {
        /** @var AuthenticatedSymfonyUser $user */
        $user = $this->getUser();
        $author = $this->userFetcher->findByUuid($user->uuid());

        $userId = $this->commandBus->dispatch(new CreateDraftCommand(
            $draftInput->title,
            $draftInput->content,
            new AuthorId($author->uuid->value())
        ));

        return new JsonResponse([
            'id' => $userId
        ]);
    }
}

