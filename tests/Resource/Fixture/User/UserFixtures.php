<?php

declare(strict_types=1);

namespace App\Tests\Resource\Fixture\User;

use App\Shared\Domain\ValueObject\Uuid;
use App\Tests\Tools\FakerTool;
use App\User\Domain\Factory\UserFactory;
use App\User\Domain\Model\User\Email;
use App\User\Domain\Model\User\Password\PlainPassword;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    use FakerTool;

    public const REFERENCE = 'user';

    public function __construct(
        private readonly UserFactory $userFactory
    ) {
    }

    public function load(ObjectManager $manager): void
    {
        $email = new Email($this->faker()->email);
        $password = new PlainPassword($this->faker()->password(8));
        $user = $this->userFactory->create(Uuid::new(), $email, $password);

        $manager->persist($user);
        $manager->flush();

        $this->addReference(self::REFERENCE, $user);
    }
}
