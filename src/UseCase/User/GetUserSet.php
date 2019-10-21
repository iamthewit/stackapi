<?php

namespace App\UseCase\User;

use App\Repository\UserEntityRepository;
use App\Stack\User;
use ArrayObject;

class GetUserSet
{
    /** @var UserEntityRepository */
    private $userEntityRepository;

    public function __construct(UserEntityRepository $userEntityRepository)
    {
        $this->userEntityRepository = $userEntityRepository;
    }

    /**
     * @param int $set
     * @param int $perSet
     *
     * @return ArrayObject
     */
    public function execute(int $set = 1, int $perSet = 10): ArrayObject
    {
        $userEntities = $this->userEntityRepository->findAllAndPaginate($set, $perSet);

        $users = new ArrayObject();
        foreach ($userEntities as $userEntity) {
            $users->append(User::buildFromEntity($userEntity));
        }

        return $users;
    }
}