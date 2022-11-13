<?php

declare(strict_types=1);

namespace App\Tests\Functional\UI\Http\Rest\Controller\GetLoggedUserInfo;

use App\Tests\Functional\ControllerTestCase;
use App\Tests\Tools\FixtureTool;
use Symfony\Component\HttpFoundation\Request;

class GetLoggedUserInfoControllerTest extends ControllerTestCase
{
    use FixtureTool;

    public function test_should_get_logged_user_info(): void
    {
        $user = $this->loadUserFixture();
        $this->loginUser($user);

        $response = $this->jsonRequest(
            Request::METHOD_GET,
            '/api/user/me',
        );

        $userDto = $this->getContent($response);

        $this->assertResponseIsSuccessful();
        $this->assertArrayHasKey('uuid', $userDto);
        $this->assertArrayHasKey('email', $userDto);
        $this->assertArrayHasKey('roles', $userDto);
    }
}
