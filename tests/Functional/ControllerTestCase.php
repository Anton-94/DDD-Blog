<?php

declare(strict_types=1);

namespace App\Tests\Functional;

use App\Tests\Tools\FixtureTool;
use App\User\Domain\Model\User\User;
use App\User\Infrastructure\Security\Symfony\AuthenticatedSymfonyUser;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class ControllerTestCase extends WebTestCase
{
    use FixtureTool;
    protected ?KernelBrowser $client;

    protected function setUp(): void
    {
        $this->client = static::createClient();
    }

    protected function jsonRequest(string $method, string $uri, array $parameters = [], array $server = [], array $content = [], array $files = [], bool $changeHistory = true): Response
    {
        $this->client->request(
            $method,
            $uri,
            $parameters,
            $files,
            $server,
            json_encode($content),
            $changeHistory
        );

        return $this->client->getResponse();
    }

    protected function getContent(Response $response): array
    {
        return json_decode($response->getContent(), true);
    }

    protected function loginUser(User $user): void
    {
        $this->client->loginUser(new AuthenticatedSymfonyUser($user));
    }
}
