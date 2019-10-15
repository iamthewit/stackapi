<?php

namespace App\UseCase\User;

use App\Repository\UserEntityRepository;
use App\Stack\User;
use ArrayObject;

class GetUsers
{
    /** @var UserEntityRepository */
    private $userEntityRepository;

    public function __construct(UserEntityRepository $userEntityRepository)
    {
        $this->userEntityRepository = $userEntityRepository;
    }

    /**
     * @return ArrayObject
     *
     * TODO: add tests for this method
     */
    public function execute(): ArrayObject
    {
        $userEntities = $this->userEntityRepository->findAll();

        $users = new ArrayObject();
        foreach ($userEntities as $userEntity) {
            $users->append(User::buildFromEntity($userEntity));
        }

        return $users;
    }
}