<?php

namespace App\Controller;

use App\UseCase\User\GetUsers;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /**
     * @Route("/user", name="user")
     *
     * @param GetUsers $getUsers
     *
     * @return JsonResponse
     */
    public function list(GetUsers $getUsers)
    {
        $users = $getUsers->execute();

        // TODO: wrap users in generic response wrapper
            // data: [user array]
            // meta: {count: x, request = y, etc, etc}

        // TODO: add test for this endpoint

        return $this->json($users->getArrayCopy());
    }
}
