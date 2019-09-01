<?php

namespace App\Tests\Integration\App\UseCase\Group;

use App\Stack\Group;
use App\Repository\QuestionGroupEntityRepository;
use App\Tests\Integration\IntegrationTest;
use App\UseCase\Group\CreateGroup;
use App\UseCase\User\RegisterUser;

class CreateGroupTest extends IntegrationTest
{
    public function testItReturnsAGroupObject()
    {
        $useCase = self::$container->get(RegisterUser::class);
        $user = $useCase->execute('123', '123', '123');

        $useCase = self::$container->get(CreateGroup::class);
        $group = $useCase->execute('123', $user);

        $this->assertInstanceOf(Group::class, $group);
    }

    public function testItStoresGroupInRepository()
    {
        // create user
        $useCase = self::$container->get(RegisterUser::class);
        $user = $useCase->execute('123', '123', '123');

        // create group
        $useCase = self::$container->get(CreateGroup::class);
        $group = $useCase->execute('123', $user);

        $repo = self::$container->get(QuestionGroupEntityRepository::class);
        $result = $repo->findBy(['id' => $group->id()->value()]);

        $this->assertCount(1, $result);
    }
}
