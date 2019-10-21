<?php

namespace App\Tests\Integration\App\UseCase\User;

use App\Entity\UserEntity;
use App\Stack\User;
use App\Tests\Integration\IntegrationTest;
use App\UseCase\User\GetUsers;
use Faker\Factory;

class GetUsersTest extends IntegrationTest
{
    public function testItReturnsAnArrayObjectOfUsers()
    {
        $faker = Factory::create();
        $faker->seed();
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

        $getUsers = self::$container->get(GetUsers::class);
        $result = $getUsers->execute();

        $this->assertInstanceOf(\ArrayObject::class, $result);
        $this->assertCount(10, $result);
        $this->assertInstanceOf(User::class, $result[0]);
    }

    public function testItReturnsAnEmptyArrayObject()
    {
        $getUsers = self::$container->get(GetUsers::class);
        $result = $getUsers->execute();

        $this->assertInstanceOf(\ArrayObject::class, $result);
        $this->assertCount(0, $result);
    }
}
