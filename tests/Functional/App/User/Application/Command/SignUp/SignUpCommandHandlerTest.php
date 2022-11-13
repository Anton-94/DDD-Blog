<?php

declare(strict_types=1);

namespace App\Tests\Functional\App\User\Application\Command\SignUp;

use App\Shared\Domain\ValueObject\Uuid;
use App\Tests\Functional\CommandTestCase;
use App\Tests\Resource\Fixture\User\UserFixtures;
use App\Tests\Tools\FakerTool;
use App\User\Application\Command\SignUp\SignUpCommand;
use App\User\Domain\Exception\EmailIsNotValidException;
use App\User\Domain\Exception\PasswordIsNotValidException;
use App\User\Domain\Exception\UserAlreadyExistsException;
use App\User\Domain\Model\User\Password\PlainPassword;
use App\User\Domain\Model\User\User;
use App\User\Domain\Repository\UserRepositoryInterface;
use Throwable;

class SignUpCommandHandlerTest extends CommandTestCase
{
    use FakerTool;

    private ?UserRepositoryInterface $userRepository;

    public function setUp(): void
    {
        parent::setUp();
        $this->userRepository = $this::getContainer()->get(UserRepositoryInterface::class);
    }

    public function needFixture(): bool
    {
        return true;
    }

    /**
     * @throws Throwable
     */
    public function test_should_create_user_successfully(): void
    {
        $command = new SignUpCommand(
            $email = $this->faker()->email,
            $this->faker()->password(PlainPassword::MIN_LENGTH)
        );

        /** @var Uuid $userUuid */
        $userUuid = $this->commandBus->dispatch($command);

        $user = $this->userRepository->findByUuid($userUuid);

        $this->assertNotNull($user);
        $this->assertEquals($user->email()->value(), $email);
    }

    /**
     * @throws Throwable
     */
    public function test_should_throw_exception_when_user_by_email_already_exists(): void
    {
        $referenceRepository = $this->databaseTool->loadFixtures([UserFixtures::class])->getReferenceRepository();
        /** @var User $user */
        $user = $referenceRepository->getReference(UserFixtures::REFERENCE);
        $existedUserEmail = $user->email();

        $this->expectException(UserAlreadyExistsException::class);

        $command = new SignUpCommand(
            $existedUserEmail->value(),
            $this->faker()->password(PlainPassword::MIN_LENGTH)
        );
        $this->commandBus->dispatch($command);
    }

    /**
     * @throws Throwable
     */
    public function test_should_throw_exception_when_email_is_not_valid(): void
    {
        $this->expectException(EmailIsNotValidException::class);

        $command = new SignUpCommand(
            'not valid email',
            $this->faker()->password(PlainPassword::MIN_LENGTH)
        );
        $this->commandBus->dispatch($command);
    }

    /**
     * @throws Throwable
     */
    public function test_should_throw_exception_when_password_min_length_is_not_valid(): void
    {
        $this->expectException(PasswordIsNotValidException::class);

        $command = new SignUpCommand(
            $this->faker()->email(),
            $this->faker()->password(7, 7)
        );
        $this->commandBus->dispatch($command);
    }
}
