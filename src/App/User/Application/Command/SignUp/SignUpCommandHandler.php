<?php

declare(strict_types=1);

namespace App\User\Application\Command\SignUp;

use App\Shared\Application\Command\CommandHandlerInterface;
use App\Shared\Domain\ValueObject\Uuid;
use App\Shared\Infrastructure\Persistence\FlusherInterface;
use App\User\Domain\Model\User\Email;
use App\User\Domain\Model\User\User;
use App\User\Domain\Repository\UserRepositoryInterface;
use App\User\Infrastructure\PasswordHasher\PasswordHasherInterface;

final class SignUpCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private readonly PasswordHasherInterface $passwordHasher,
        private readonly UserRepositoryInterface $userRepository,
        private readonly FlusherInterface $flusher
    ) {
    }

    public function __invoke(SignUpCommand $command): void
    {
        /* @todo validation for uniq email */

        $password = $this->passwordHasher->hash($command->password);
        $email = new Email($command->email);

        $user = new User(
            Uuid::new(),
            $email,
            $password
        );

        $this->userRepository->store($user);
        $this->flusher->flush();

        /* @todo add event 'UserCreated' */
    }
}
