<?php

declare(strict_types=1);

namespace App\User\Domain\Model\User;

use App\Shared\Domain\Model\Aggregate;
use App\Shared\Domain\Model\DatesTrait;
use App\Shared\Domain\Model\IdTrait;
use App\Shared\Domain\Model\UuidTrait;
use App\Shared\Domain\ValueObject\Uuid;
use App\User\Domain\Enum\RoleEnum;
use App\User\Domain\Exception\UserAlreadyExistsException;
use App\User\Domain\Model\User\Password\HashedPassword;
use App\User\Domain\Model\User\Password\PlainPassword;
use App\User\Domain\Repository\UserRepositoryInterface;
use App\User\Domain\Service\UserPasswordHasherInterface;
use App\User\Domain\Specification\UserAlreadyExistsByEmailSpecificationInterface;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepositoryInterface::class)]
#[ORM\Table('users_user')]
#[ORM\HasLifecycleCallbacks]
class User extends Aggregate
{
    use IdTrait;
    use UuidTrait;
    use DatesTrait;

    #[ORM\Column(type: 'user_email')]
    private Email $email;

    #[ORM\Column(type: 'user_password', nullable: true)]
    private ?HashedPassword $password = null;

    #[ORM\Column(type: 'simple_array')]
    private array $roles;

    public function __construct(Uuid $uuid, Email $email, UserAlreadyExistsByEmailSpecificationInterface $userAlreadyExistsByEmailSpecification)
    {
        if ($userAlreadyExistsByEmailSpecification->alreadyExists($email)) {
            throw new UserAlreadyExistsException('User already exists by this email');
        }

        $this->createdAt = new DateTimeImmutable();
        $this->uuid = $uuid;
        $this->email = $email;
        $this->roles = [RoleEnum::ROLE_USER->value];
    }

    public function email(): Email
    {
        return $this->email;
    }

    public function password(): ?HashedPassword
    {
        return $this->password;
    }

    public function setPassword(PlainPassword $password, UserPasswordHasherInterface $passwordHasher): void
    {
        $this->password = $passwordHasher->hash($password, $this);
    }

    public function addRole(RoleEnum $role): void
    {
        $this->roles[] = $role->value;
    }

    /** @return string[] */
    public function roles(): array
    {
        return $this->roles;
    }
}
