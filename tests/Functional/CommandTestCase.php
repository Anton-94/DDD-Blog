<?php

declare(strict_types=1);

namespace App\Tests\Functional;

use App\Shared\Application\Command\CommandBusInterface;
use Exception;
use Liip\TestFixturesBundle\Services\DatabaseToolCollection;
use Liip\TestFixturesBundle\Services\DatabaseTools\AbstractDatabaseTool;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CommandTestCase extends WebTestCase
{
    protected CommandBusInterface $commandBus;
    protected ?AbstractDatabaseTool $databaseTool = null;

    /** @throws Exception */
    public function setUp(): void
    {
        parent::setUp();
        $this->commandBus = $this::getContainer()->get(CommandBusInterface::class);

        if ($this->needFixture()) {
            $this->databaseTool = $this::getContainer()->get(DatabaseToolCollection::class)->get();
        }
    }

    public function needFixture(): bool
    {
        return false;
    }
}
