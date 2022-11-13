<?php

declare(strict_types=1);

namespace App\Tests\Tools;

use App\Tests\Resource\Fixture\User\UserFixtures;
use App\User\Domain\Model\User\User;
use Liip\TestFixturesBundle\Services\DatabaseToolCollection;
use Liip\TestFixturesBundle\Services\DatabaseTools\AbstractDatabaseTool;

trait FixtureTool
{
    public function getDatabaseTools(): AbstractDatabaseTool
    {
        return static::getContainer()->get(DatabaseToolCollection::class)->get();
    }

    public function loadUserFixture(): User
    {
        $executor = $this->getDatabaseTools()->loadFixtures([UserFixtures::class]);
        /** @var User $user */
        $user = $executor->getReferenceRepository()->getReference(UserFixtures::REFERENCE);

        return $user;
    }
}
