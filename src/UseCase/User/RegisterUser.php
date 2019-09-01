<?php

namespace App\UseCase\User;

use App\EntityFactory\EntityFactory;
use App\Stack\Factory\IdFactory;
use App\Stack\User;
use App\Entity\UserEntity;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\ORMException;

class RegisterUser
{
    /** @var EntityManagerInterface */
    private $entityManager;

    /** @var EntityFactory */
    private $entityFactory;

    public function __construct(
        EntityManagerInterface $entityManager,
        EntityFactory $entityFactory
    ) {
        $this->entityManager = $entityManager;
        $this->entityFactory = $entityFactory;
    }

    public function execute(string $username, string $email, string $password)
    {
        // create user object
        $user = User::buildFromValues(
            IdFactory::generateFromRandom(),
            $username,
            $email,
            $password,
            new DateTimeImmutable(),
            new DateTimeImmutable(),
            null
        );

        // create entity based on user object
        $userEntity = $this->entityFactory->buildUserEntityFromUser($user);

        // pass entity to repo for storage
        try {
            $this->entityManager->persist($userEntity);
            $this->entityManager->flush();
        } catch (ORMException $e) {
            // TODO: create CanNotPersistsUserEntityException
        }

        // return user object
        return $user;
    }
}