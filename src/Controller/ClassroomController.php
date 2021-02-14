<?php

namespace App\Controller;

use App\Repository\ClassroomRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Service\Attribute\Required;

class ClassroomController extends AbstractController
{
    #[Required]
    public ClassroomRepository $repository;

    #[Route('/classroom')]
    public function index(): Response
    {
        return $this->render('classroom/index.html.twig', [
            'controller_name' => 'ClassroomController',
        ]);
    }

    #[Route('/api/classrooms', methods: ['GET'])]
    public function getClassrooms(Request $request): Response
    {
        $limit = $request->query->get('limit') ?? 10;
        $offset = $request->query->get('offset') ?? 0;

        $data = $this->repository->getList($limit, $offset);
        $code = $data ? 200 : 404;

        return $this->response($data)->setStatusCode($code);
    }

    //
    // public function test(): Response
    // {
    //     return $this->res
    // }
}
