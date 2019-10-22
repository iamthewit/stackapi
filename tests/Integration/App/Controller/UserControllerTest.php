<?php

namespace App\Tests\Integration\App\Controller;

use App\Controller\UserController;
use App\Entity\UserEntity;
use App\Tests\Integration\IntegrationTest;
use PHPUnit\Framework\TestCase;

class UserControllerTest extends IntegrationTest
{
    public function testList()
    {
        // TODO: create entity factories and move this to a test helper / trait
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

        $client = $this->createClient();

        $client->request('GET', '/users');

        d($client->getResponse());
        die;
    }
}
