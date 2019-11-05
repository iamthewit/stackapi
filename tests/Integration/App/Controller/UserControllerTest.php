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

        $client = $this->client();
        $client->request('GET', '/users');

        $response = $client->getResponse();
        $body = json_decode($response->getContent(), true);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertArrayHasKey('data', $body);
        $this->assertArrayHasKey('meta', $body);

        $this->assertIsArray($body['data']);
        $this->assertCount(10, $body['data']);

        foreach ($body['data'] as $user) {
            $this->assertArrayHasKey('id', $user);
            $this->assertArrayHasKey('username', $user);
            $this->assertArrayHasKey('email', $user);
            $this->assertArrayHasKey('createdAt', $user);
            $this->assertArrayHasKey('updatedAt', $user);
        }

        $this->assertArrayHasKey('uri', $body['meta']);
        $this->assertEquals($client->getRequest()->getRequestUri(), $body['meta']['uri']);

        $this->assertArrayHasKey('resultCount', $body['meta']);
        $this->assertEquals(10, $body['meta']['resultCount']);
    }
}
