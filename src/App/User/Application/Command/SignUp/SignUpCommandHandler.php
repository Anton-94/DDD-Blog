<?php

declare(strict_types=1);

namespace App\User\Application\Command\SignUp;

use App\Shared\Application\Command\CommandHandlerInterface;
use App\Shared\Domain\ValueObject\Uuid;
use App\User\Domain\Exception\EmailIsNotValidException;
use App\User\Domain\Exception\PasswordIsNotValidException;
use App\User\Domain\Exception\UserAlreadyExistsException;
use App\User\Domain\Factory\UserFactory;
use App\User\Domain\Model\User\Email;
use App\User\Domain\Model\User\Password\PlainPassword;
use App\User\Domain\Repository\UserRepositoryInterface;

final class SignUpCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private readonly UserFactory $userFactory,
        private readonly UserRepositoryInterface $userRepository
    ) {
    }

    /**
     * @throws UserAlreadyExistsException
     * @throws PasswordIsNotValidException
     * @throws EmailIsNotValidException
     */
    public function __invoke(SignUpCommand $command): Uuid
    {
        $user = $this->userFactory->create(
            $userId = Uuid::new(),
            new Email($command->email),
            new PlainPassword($command->password)
        );

        $this->userRepository->store($user);

        /* @todo add event 'UserCreated' */

        return $userId;
    }
}
