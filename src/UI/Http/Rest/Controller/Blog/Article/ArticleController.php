<?php

declare(strict_types=1);

namespace UI\Http\Rest\Controller\Blog\Article;

use App\Blog\Application\Command\Article\ChangeToDraft\ChangeToDraftCommand;
use App\Blog\Application\Command\Article\CreateDraft\CreateDraftCommand;
use App\Blog\Application\Command\Article\PublishDraft\PublishDraftCommand;
use App\Shared\Application\Command\CommandBusInterface;
use App\Shared\Domain\ValueObject\Uuid;
use App\User\Application\Fetcher\UserFetcher;
use App\User\Infrastructure\Security\Symfony\AuthenticatedSymfonyUser;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use UI\Http\Rest\Controller\AbstractApiController;
use UI\Http\Rest\Input\Blog\Article\DraftInput;

#[Route('/api/articles', name: 'api_articles')]
class ArticleController extends AbstractApiController
{
    public function __construct(
        private readonly CommandBusInterface $commandBus,
        private readonly UserFetcher $userFetcher
    ) {
    }

    #[Route('/create-draft', name: '_create-draft', methods: ['POST'])]
    public function create(DraftInput $draftInput): Response
    {
        /** @var AuthenticatedSymfonyUser $user */
        $user = $this->getUser();
        $author = $this->userFetcher->findByUuid($user->uuid());

        /** @var Uuid $userId */
        $userId = $this->commandBus->dispatch(new CreateDraftCommand(
            $draftInput->title,
            $draftInput->content,
            $author->uuid
        ));

        return new JsonResponse([
            'id' => $userId
        ]);
    }

    #[Route('/{articleId}/publish', name: '_publish', methods: ['PUT'])]
    public function publish(string $articleId): Response
    {
        /** @var AuthenticatedSymfonyUser $user */
        $user = $this->getUser();
        $author = $this->userFetcher->findByUuid($user->uuid());

        /** @var Uuid $publishedDraftId */
        $publishedDraftId = $this->commandBus->dispatch(new PublishDraftCommand(
            $author->uuid,
            new Uuid($articleId)
        ));

        return new JsonResponse([
            'id' => $publishedDraftId
        ]);
    }

    #[Route('/{articleId}/draft', name: '_draft', methods: ['PUT'])]
    public function draft(string $articleId): Response
    {
        /** @var AuthenticatedSymfonyUser $user */
        $user = $this->getUser();
        $author = $this->userFetcher->findByUuid($user->uuid());

        /** @var Uuid $publishedDraftId */
        $publishedDraftId = $this->commandBus->dispatch(new ChangeToDraftCommand(
            $author->uuid,
            new Uuid($articleId)
        ));

        return new JsonResponse([
            'id' => $publishedDraftId
        ]);
    }
}

