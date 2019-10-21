<?php

namespace App\Controller;

use App\UseCase\User\GetUserSet;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /**
     * @Route("/user", name="user")
     *
     * @param Request    $request
     * @param GetUserSet $getUsers
     *
     * @return JsonResponse
     */
    public function list(Request $request, GetUserSet $getUsers)
    {
        $page = $request->query->get('page', 1);
        $perPage = $request->query->get('perPage', 10);

        $users = $getUsers->execute($page, $perPage);

        // TODO: wrap users in generic response wrapper
            // data: [user array]
            // meta: {count: x, request = y, etc, etc}

        // TODO: add test for this endpoint

        return $this->json($users->getArrayCopy());
    }
}
