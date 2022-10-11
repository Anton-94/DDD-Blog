<?php

declare(strict_types=1);

namespace App\Modules\User\Application\Command\SignUp;

use App\Modules\Shared\Application\Command\CommandHandlerInterface;
use App\Modules\Shared\Domain\ValueObject\Uuid;
use App\Modules\Shared\Infrastructure\Persistence\FlusherInterface;
use App\Modules\User\Domain\Entity\User\Email;
use App\Modules\User\Domain\Entity\User\User;
use App\Modules\User\Domain\Repository\UserRepositoryInterface;
use App\Modules\User\Infrastructure\PasswordHasher\PasswordHasherInterface;

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
