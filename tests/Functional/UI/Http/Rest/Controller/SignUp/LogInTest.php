<?php

declare(strict_types=1);

namespace App\Tests\Functional\UI\Http\Rest\Controller\SignUp;

use App\Tests\Functional\ControllerTestCase;
use App\User\Domain\Model\User\Email;
use App\User\Domain\Repository\UserRepositoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class LogInTest extends ControllerTestCase
{
    private ?UserRepositoryInterface $userRepository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->userRepository = $this::getContainer()->get(UserRepositoryInterface::class);
    }

    public function test_should_log_in_user_successfully(): void
    {
        $email = 'test@mail.com';
        $this->jsonRequest(
            Request::METHOD_POST,
            '/api/sign-up',
            [],
            ['CONTENT_TYPE' => 'application/json'],
            [
                'email' => $email,
                'password' => 'test1234',
            ]
        );

        $response = $this->jsonRequest(
            Request::METHOD_POST,
            '/api/auth/token/login',
            [],
            ['CONTENT_TYPE' => 'application/json'],
            [
                'username' => $email,
                'password' => 'test1234',
            ]
        );

        $this->assertArrayHasKey('token', $this->getContent($response));
    }
}
