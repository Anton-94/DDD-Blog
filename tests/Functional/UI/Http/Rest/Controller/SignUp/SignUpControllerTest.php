<?php

declare(strict_types=1);

namespace App\Tests\Functional\UI\Http\Rest\Controller\SignUp;

use App\Tests\Functional\ControllerTestCase;
use App\User\Domain\Model\User\Email;
use App\User\Domain\Repository\UserRepositoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SignUpControllerTest extends ControllerTestCase
{
    private ?UserRepositoryInterface $userRepository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->userRepository = $this::getContainer()->get(UserRepositoryInterface::class);
    }

    public function test_should_sign_up_new_user_successfully(): void
    {
        $email = 'test@mail.com';
        $response = $this->jsonRequest(
            Request::METHOD_POST,
            '/api/sign-up',
            [],
            ['CONTENT_TYPE' => 'application/json'],
            [
                'email' => $email,
                'password' => 'test1234',
            ]
        );

        $user = $this->userRepository->findByEmail(new Email($email));

        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());
        $this->assertNotNull($user);
        $this->assertEquals($email, $user->email()->value());
    }
}
