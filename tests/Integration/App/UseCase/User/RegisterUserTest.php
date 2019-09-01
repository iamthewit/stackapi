<?php

namespace App\Tests\Integration\App\UseCase\User;

use App\Stack\User;
use App\Repository\UserEntityRepository;
use App\Tests\Integration\IntegrationTest;
use App\UseCase\User\RegisterUser;

class RegisterUserTest extends IntegrationTest
{
    public function testItReturnsAUser()
    {
        $useCase = self::$container->get(RegisterUser::class);

        $user = $useCase->execute('123', '123', '123');

        $this->assertInstanceOf(User::class, $user);
    }

    public function testItStoresUserInRepository()
    {
        $useCase = self::$container->get(RegisterUser::class);
        $user = $useCase->execute('123', '123', '123');

        $repo = self::$container->get(UserEntityRepository::class);
        $result = $repo->findBy(['id' => $user->id()->value()]);

        $this->assertCount(1, $result);
    }
}
