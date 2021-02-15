<?php

namespace App\Repository;

use App\Entity\Classroom;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

class ClassroomRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Classroom::class);
    }

    /**
     * Get list of classrooms
     *
     * @param int $limit
     * @param int $offset
     *
     * @return array
     */
    public function getList(int $limit, int $offset): array
    {
        $limit = $limit < 100 ? $limit : 100;

        return $this->findBy([], ['id' => 'asc'], $limit, $offset);
    }

    /**
     * Select one classroom or return null
     *
     * @param int $id
     *
     * @return Classroom|null
     */
    public function getOne(int $id): ?Classroom
    {
        /**
         * @noinspection PhpIncompatibleReturnTypeInspection
         */
        return $this->find($id);
    }

    /**
     * Create new or replace classroom
     *
     * @param Classroom|null $current saved
     * @param Classroom $modified new data
     *
     * @return void
     *
     * @throws ORMException
     */
    public function save(?Classroom $current, Classroom $modified): void
    {
        $em = $this->getEntityManager();

        if (isset($current)) {
            $save = $current;

            $save->setName($modified->getName());
            $save->setActive($modified->getActive());
            $save->setFormedAt($modified->getFormedAt());
        } else {
            $save = $modified;
        }

        $em->persist($save);
        $em->flush();
    }
}
