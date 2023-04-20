<?php

declare(strict_types=1);

namespace App\User\Infrastructure\Security\Symfony\UserProvider;

use App\User\Domain\Model\User\Email;
use App\User\Domain\Repository\UserRepositoryInterface;
use App\User\Infrastructure\Security\Symfony\AuthenticatedSymfonyUser;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\Exception\UserNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class UserByEmailAdminProvider implements UserProviderInterface
{
    public function __construct(
        private readonly UserRepositoryInterface $userRepository
    ) {
    }

    /**
     * @throws UserNotFoundException
     */
    public function loadUserByIdentifier(string $identifier): UserInterface
    {
        $user = $this->userRepository->findByEmail(new Email($identifier))
            ?? throw new UserNotFoundException('User not found');

        return new AuthenticatedSymfonyUser($user);
    }

    /**
     * @throws UserNotFoundException|UnsupportedUserException
     */
    public function refreshUser(UserInterface $user): UserInterface
    {
        if (!$user instanceof AuthenticatedSymfonyUser) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', get_class($user)));
        }

        $user = $this->userRepository->findByEmail(new Email($user->getUserIdentifier()))
            ?? throw new UserNotFoundException();

        return new AuthenticatedSymfonyUser($user);
    }

    public function supportsClass(string $class): bool
    {
        return AuthenticatedSymfonyUser::class === $class;
    }
}
