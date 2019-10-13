<?php

namespace App\Tests\Integration;

use App\Entity\AnswerEntity;
use App\Entity\QuestionEntity;
use App\Entity\QuestionGroupEntity;
use App\Entity\UserEntity;
use Doctrine\ORM\Tools\SchemaTool;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class IntegrationTest extends KernelTestCase
{
    public function setUp()
    {
        $kernel = self::bootKernel();
        self::$container = $kernel->getContainer();

        $entityManager = self::$container->get('doctrine.orm.entity_manager');

        $metaData = [
            $entityManager->getClassMetadata(UserEntity::class),
            $entityManager->getClassMetadata(QuestionGroupEntity::class),
            $entityManager->getClassMetadata(QuestionEntity::class),
            $entityManager->getClassMetadata(AnswerEntity::class)
            // TODO: add each entity here
        ];

        $schemaTool = new SchemaTool($entityManager);
        $schemaTool->dropDatabase();
        $schemaTool->createSchema($metaData);
    }
}