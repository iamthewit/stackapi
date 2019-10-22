<?php

namespace App\Tests\Integration;

use App\Entity\AnswerEntity;
use App\Entity\QuestionEntity;
use App\Entity\QuestionGroupEntity;
use App\Entity\UserEntity;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\Tools\SchemaTool;
use Nelmio\Alice\Loader\NativeLoader;
use Nelmio\Alice\ObjectSet;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\DependencyInjection\Exception\ServiceNotFoundException;

class IntegrationTest extends WebTestCase
{
    // TODO: move this functionality out into traits
        // container trait
        // DB trait
        // controller / request trait

//    private $kernel;

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

    /**
     * @param array $dataToLoad
     *
     * @return ObjectSet
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function loadData(array $dataToLoad)
    {
        $em = self::$container->get('doctrine.orm.entity_manager');
        $objectSet = (new NativeLoader())->loadData($dataToLoad);

        foreach ($objectSet->getObjects() as $object) {
            $em->persist($object);
        }
        $em->flush();

        return $objectSet;
    }

    /**
     * Creates a KernelBrowser.
     *
     * @param array $options An array of options to pass to the createKernel method
     * @param array $server  An array of server parameters
     *
     * @return KernelBrowser A KernelBrowser instance
     */
    public function createClient(array $options = [], array $server = [])
    {
        try {
            $client = self::$kernel->getContainer()->get('test.client');
        } catch (ServiceNotFoundException $e) {
            if (class_exists(KernelBrowser::class)) {
                throw new \LogicException('You cannot create the client used in functional tests if the "framework.test" config is not set to true.');
            }
            throw new \LogicException('You cannot create the client used in functional tests if the BrowserKit component is not available. Try running "composer require symfony/browser-kit"');
        }

        $client->setServerParameters($server);

        return $client;
    }
}