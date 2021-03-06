<?php

namespace App\Tests\Integration\App\UseCase\User;

use App\Entity\UserEntity;
use App\Stack\User;
use App\Tests\Integration\IntegrationTest;
use App\UseCase\User\GetUserSet;
use Faker\Factory;

class GetUserSetTest extends IntegrationTest
{
    public function testItReturnsArrayObjectOfUsers()
    {
        $users = [
            UserEntity::class => [
                'user{1..10}' => [
                    'id' => '<uuid()>',
                    'username' => '<userName()>',
                    'email' => '<email()>',
                    'password' => 'hashed_password',
                    'createdAt' => new \DateTimeImmutable(),
                    'updatedAt' => new \DateTimeImmutable()
                ]
            ]
        ];
        $this->loadData($users);

        $getUsers = self::$container->get(GetUserSet::class);
        $result = $getUsers->execute();

        $this->assertInstanceOf(\ArrayObject::class, $result);
        $this->assertCount(10, $result);
        $this->assertInstanceOf(User::class, $result[0]);
    }

    public function testItReturnsAnEmptyArrayObject()
    {
        $getUsers = self::$container->get(GetUserSet::class);
        $result = $getUsers->execute();

        $this->assertInstanceOf(\ArrayObject::class, $result);
        $this->assertCount(0, $result);
    }

    public function testItReturnsLimitedSetArrayObjectOfUsers()
    {
        $users = [
            UserEntity::class => [
                'user{1..10}' => [
                    'id' => '<uuid()>',
                    'username' => '<userName()>',
                    'email' => '<email()>',
                    'password' => 'hashed_password',
                    'createdAt' => new \DateTimeImmutable(),
                    'updatedAt' => new \DateTimeImmutable()
                ]
            ]
        ];
        $this->loadData($users);

        $getUsers = self::$container->get(GetUserSet::class);
        $result = $getUsers->execute(1, 5);

        $this->assertInstanceOf(\ArrayObject::class, $result);
        $this->assertCount(5, $result);
        $this->assertInstanceOf(User::class, $result[0]);
    }
}
