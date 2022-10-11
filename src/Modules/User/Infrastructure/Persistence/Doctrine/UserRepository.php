<?php

declare(strict_types=1);

namespace App\Modules\User\Infrastructure\Persistence\Doctrine;

use App\Modules\User\Domain\Entity\User\Email;
use App\Modules\User\Domain\Entity\User\User;
use App\Modules\User\Domain\Repository\UserRepositoryInterface;
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
