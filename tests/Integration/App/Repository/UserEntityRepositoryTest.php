<?php

namespace App\Tests\Integration\App\Repository;

use App\Entity\UserEntity;
use App\Repository\UserEntityRepository;
use App\Tests\Integration\IntegrationTest;
use PHPUnit\Framework\TestCase;

class UserEntityRepositoryTest extends IntegrationTest
{
    public function testFindAll()
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

        $repository = self::$container->get(UserEntityRepository::class);
        $set = $repository->findAll();

        $this->assertIsArray($set);
        $this->assertCount(10, $set);
        $this->assertContainsOnlyInstancesOf(UserEntity::class, $set);
    }

    public function testFindAllAndPaginate()
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

        $repository = self::$container->get(UserEntityRepository::class);
        $firstSet = $repository->findAllAndPaginate(1, 5);
        $secondSet = $repository->findAllAndPaginate(2, 5);

        $this->assertContainsOnlyInstancesOf(UserEntity::class, $firstSet);
        $this->assertCount(5, $firstSet);

        $this->assertContainsOnlyInstancesOf(UserEntity::class, $secondSet);
        $this->assertCount(5,$secondSet);

        $this->assertNotEquals($firstSet, $secondSet);
    }

    public function testFindAllAndPaginateReturnsEmptyArrayWhenPaginatingTooFar()
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

        $repository = self::$container->get(UserEntityRepository::class);
        $set = $repository->findAllAndPaginate(2, 10);

        $this->assertIsArray($set);
        $this->assertCount(0, $set);
    }

    public function testFindAllAndPaginateReturnsEmptyArrayWhenThereAreNoResults()
    {
        $repository = self::$container->get(UserEntityRepository::class);
        $set = $repository->findAllAndPaginate(1, 10);

        $this->assertIsArray($set);
        $this->assertCount(0, $set);
    }
}
