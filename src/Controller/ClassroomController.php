<?php

/**
 * @noinspection PhpUnused
 * @noinspection PhpDocSignatureInspection
 */

namespace App\Controller;

use App\Entity\Classroom;
use App\Repository\ClassroomRepository;
use App\Service\ApiParamConverter;
use Doctrine\ORM\ORMException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Service\Attribute\Required;

class ClassroomController extends AbstractController
{
    #[Required]
    public ClassroomRepository $repository;

    #[Route('/')]
    public function index(): Response
    {
        return $this->redirect($this->getParameter('app.homepage'));
    }

    /**
     * Get list of classrooms
     */
    #[Route('/api/classrooms', methods: ['GET'])]
    public function getClassrooms(Request $request): Response
    {
        $limit = $request->query->get('limit') ?? 10;
        $offset = $request->query->get('offset') ?? 0;

        $data = $this->repository->getList($limit, $offset);
        $code = $data ? 200 : 404;

        return $this->response($data)->setStatusCode($code);
    }

    /**
     * Get one classroom by id
     */
    #[Route('/api/classroom/{id}', methods: ['GET'])]
    public function getClassroom(?Classroom $entity): Response
    {
        return $this->response($entity)->setStatusCode($entity ? 200 : 404);
    }

    /**
     * Create new or replace a classroom
     *
     * @ParamConverter("current", converter="doctrine.orm")
     * @ParamConverter("modified", converter="api")
     */
    #[Route('/api/classroom/{id}', defaults: ['id' => null], methods: ['POST', 'PUT'])]
    public function saveClassroom(?Classroom $current, Classroom $modified, bool $replace = true): Response
    {
        try {
            $this->repository->save($current, $modified, $replace);
            [$success, $message] = [true, 'saved'];
        } catch (ORMException $e) {
            [$success, $message] = [false, $e->getMessage()];
        }

        return $this
            ->response(compact("success", "message"))
            ->setStatusCode($success ? 200 : 400);
    }

    /**
     * Create new or replace a classroom
     *
     * @ParamConverter("current", converter="doctrine.orm")
     * @ParamConverter("modified", converter="api")
     */
    #[Route('/api/classroom/{id}', methods: ['PATCH'])]
    public function patchClassroom(Classroom $current, Classroom $modified): Response
    {
        return $this->saveClassroom($current, $modified, false);
    }
}
