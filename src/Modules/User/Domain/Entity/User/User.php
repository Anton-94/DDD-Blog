<?php

declare(strict_types=1);

namespace App\Modules\User\Domain\Entity\User;

use App\Modules\Shared\Domain\Entity\DatesTrait;
use App\Modules\Shared\Domain\Entity\ExposedIdTrait;
use App\Modules\Shared\Domain\Entity\IdTrait;
use App\Modules\Shared\Domain\ValueObject\Uuid;
use App\Modules\User\Domain\Enum\RoleEnum;
use App\Modules\User\Infrastructure\Persistence\Doctrine\UserRepository;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table('user_user')]
#[ORM\HasLifecycleCallbacks]
class User
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
