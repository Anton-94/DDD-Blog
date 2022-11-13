<?php

declare(strict_types=1);

namespace App\User\Infrastructure\Persistence\Doctrine;

use App\Shared\Domain\ValueObject\Uuid;
use App\User\Domain\Model\User\Email;
use App\User\Domain\Model\User\User;
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
        $this->getEntityManager()->persist($user);
        $this->getEntityManager()->flush();
    }

    public function findByEmail(Email $email): ?User
    {
        return $this->findOneBy(['email' => $email]);
    }

    public function findByUuid(Uuid $uuid): ?User
    {
        return $this->findOneBy(['uuid' => $uuid]);
    }
}
