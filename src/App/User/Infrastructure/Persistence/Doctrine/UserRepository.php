<?php

declare(strict_types=1);

namespace App\User\Infrastructure\Persistence\Doctrine;

use App\User\Domain\Entity\User\Email;
use App\User\Domain\Entity\User\User;
use App\User\Domain\Repository\UserRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class UserRepository extends ServiceEntityRepository implements UserRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    public function store(User $user): void
    {
        $this->_em->persist($user);
    }

    public function findByEmail(Email $email): ?User
    {
        return $this->findOneBy(['email' => $email]);
    }
}
