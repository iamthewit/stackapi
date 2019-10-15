<?php

namespace App\UseCase\User;

use App\Factory\EntityFactory;
use App\Factory\IdFactory;
use App\Stack\User;
use App\Entity\UserEntity;
use App\UseCase\Exception\CanNotPersistUserEntityException;
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

    /**
     * @param string $username
     * @param string $email
     * @param string $password
     *
     * @return User
     * @throws CanNotPersistUserEntityException
     */
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
        $userEntity = $this->entityFactory->buildUserEntity($user);

        // pass entity to repo for storage
        try {
            $this->entityManager->persist($userEntity);
            $this->entityManager->flush();
        } catch (ORMException $e) {
            $m = 'Can not persist user entity.';
            throw new CanNotPersistUserEntityException($m, 0, $e);
        }

        // TODO: fire user created event
        return $user;
    }
}