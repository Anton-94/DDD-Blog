<?php

declare(strict_types=1);

namespace App\User\Domain\Model\User;

use App\Shared\Domain\Model\Aggregate;
use App\Shared\Domain\Model\DatesTrait;
use App\Shared\Domain\Model\ExposedIdTrait;
use App\Shared\Domain\Model\IdTrait;
use App\Shared\Domain\ValueObject\Uuid;
use App\User\Domain\Enum\RoleEnum;
use App\User\Infrastructure\Persistence\Doctrine\UserRepository;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table('users_user')]
#[ORM\HasLifecycleCallbacks]
class User extends Aggregate
{
    use IdTrait;
    use ExposedIdTrait;
    use DatesTrait;

    #[ORM\Column(type: 'user_email')]
    private Email $email;

    #[ORM\Column(type: 'user_password')]
    private Password $password;

    #[ORM\Column(type: 'simple_array')]
    private array $roles;

    public function __construct(Uuid $uuid, Email $email, Password $password)
    {
        $this->createdAt = new DateTimeImmutable();
        $this->exposedId = $uuid;
        $this->email = $email;
        $this->password = $password;
        $this->roles = [RoleEnum::ROLE_USER->value];
    }

    public function email(): Email
    {
        return $this->email;
    }

    public function password(): Password
    {
        return $this->password;
    }

    public function addRole(RoleEnum $role): void
    {
        $this->roles[] = $role->value;
    }

    public function roles(): array
    {
        return $this->roles;
    }
}
