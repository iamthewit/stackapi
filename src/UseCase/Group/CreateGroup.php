<?php

namespace App\UseCase\Group;

use App\Factory\EntityFactory;
use App\Factory\IdFactory;
use App\Stack\Group;
use App\Stack\User;
use App\UseCase\Exception\CanNotPersistGroupEntityException;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\ORMException;

class CreateGroup
{
    /** @var EntityManagerInterface */
    private $entityManager;

    /** @var EntityFactory */
    private $entityFactory;

    /**
     * CreateGroup constructor.
     *
     * @param EntityManagerInterface $entityManager
     * @param EntityFactory          $entityFactory
     */
    public function __construct(
        EntityManagerInterface $entityManager,
        EntityFactory $entityFactory
    ) {
        $this->entityManager = $entityManager;
        $this->entityFactory = $entityFactory;
    }

    /**
     * @param string $name
     * @param User   $user
     *
     * @return Group
     * @throws CanNotPersistGroupEntityException
     */
    public function execute(string $name, User $user): Group
    {
        // create group object
        $group = Group::buildFromValues(
            IdFactory::generateFromRandom(),
            $name,
            $user->id(),
            new DateTimeImmutable(),
            new DateTimeImmutable(),
            null
        );

        // create entity based on group object
        $groupEntity = $this->entityFactory->buildQuestionGroupEntity($group);

        // persist entity
        try {
            $this->entityManager->persist($groupEntity);
            $this->entityManager->flush();
        } catch (ORMException $e) {
            $m = 'Can not persist group entity';
            throw new CanNotPersistGroupEntityException($m, 0, $e);
        }

        // TODO: fire group created event
        return $group;
    }
}