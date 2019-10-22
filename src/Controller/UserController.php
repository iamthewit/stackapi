<?php

namespace App\Controller;

use App\Http\Meta;
use App\Http\Response;
use App\UseCase\User\GetUserSet;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /**
     * @Route("/users", name="user")
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

        $meta = new Meta($request->getRequestUri(), count($users),[]);
        $response = new Response($users->getArrayCopy(), $meta);

        // TODO: add test for this endpoint

        return $this->json($response);
    }

    public function create()
    {
        // TODO
    }

    public function read()
    {
        // return info on a single user

        // TODO: links array could contain:
            // uri to a users questions - /user/ID/questions
            // uri to a users answers - /user/ID/answers
//        $links = [
//            new Link('/users/')
//        ];
    }

    public function update()
    {
        // TODO
    }

    public function delete()
    {
        // TODO
    }
}
