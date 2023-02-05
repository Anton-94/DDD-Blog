<?php

declare(strict_types=1);

namespace App\Tests\Functional\App\Blog\Application\Command\CreateDraft;

use App\Blog\Application\Command\Article\CreateDraft\CreateDraftCommand;
use App\Blog\Domain\Enum\Article\StatusEnum;
use App\Blog\Domain\Model\Author\AuthorId;
use App\Blog\Domain\Repository\ArticleRepositoryInterface;
use App\Shared\Domain\ValueObject\Uuid;
use App\Tests\Functional\CommandTestCase;
use App\Tests\Tools\FakerTool;
use Throwable;

class CreateDraftCommandHandlerTest extends CommandTestCase
{
    use FakerTool;

    private ?ArticleRepositoryInterface $articleRepository;

    public function setUp(): void
    {
        parent::setUp();
        $this->articleRepository = $this::getContainer()->get(ArticleRepositoryInterface::class);
    }

    /**
     * @throws Throwable
     */
    public function test_should_create_user_successfully(): void
    {
        $command = new CreateDraftCommand(
            $name = $this->faker()->name,
            $content = $this->faker()->text,
            $authorId = AuthorId::new()
        );

        /** @var Uuid $userUuid */
        $articleUuid = $this->commandBus->dispatch($command);

        $article = $this->articleRepository->findByUuid($articleUuid);

        $this->assertNotNull($article);
        $this->assertEquals($name, $article->name());
        $this->assertNotEmpty($content);
        $this->assertEquals($authorId, $article->authorId()->value());
        $this->assertEquals(StatusEnum::DRAFT, $article->status()->type());
        $this->assertEmpty($article->comments());
    }
}
