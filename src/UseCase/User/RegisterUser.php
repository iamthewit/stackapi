<?php

namespace App\UseCase\User;

use App\BeautyStackOverflow\Factory\IdFactory;
use App\BeautyStackOverflow\User;

class RegisterUser
{
    /** @var IdFactory */
    private $idFactory;

    public function __construct(IdFactory $idFactory)
    {
        $this->idFactory = $idFactory;
    }

    public function execute(string $username, string $email, string $password)
    {
        // create user object
        $user = User::buildFromValues(
            $this->idFactory->buildFromRamseyUuid(),
            $username,
            $email,
            $password,
            new \DateTimeImmutable(),
            new \DateTimeImmutable(),
            new \DateTimeImmutable()
        );

        // create entity based on user object
        $userEntity = UserEntity::createFromObject($user);

        // pass entity to repo for storage
        try {
            $userRepository->persist($userEntity);
        } catch () {

        }

        // return user object
        return $user;
    }
}