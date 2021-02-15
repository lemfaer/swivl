<?php

namespace App\Repository;

use App\Entity\Classroom;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
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
     * @param bool $replace replace or patch
     *
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function save(?Classroom $current, Classroom $modified, bool $replace = false): void
    {
        $em = $this->getEntityManager();

        if (isset($current)) {
            $save = $current;

            if ($replace || null !== $modified->getName()) {
                $save->setName($modified->getName());
            }

            if ($replace || null !== $modified->getActive()) {
                $save->setActive($modified->getActive());
            }

            if ($replace || null !== $modified->getFormedAt()) {
                $save->setFormedAt($modified->getFormedAt());
            }
        } else {
            $save = $modified;
        }

        $em->persist($save);
        $em->flush();
    }

    /**
     * Delete classroom
     *
     * @param Classroom $entity record to delete
     *
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function delete(Classroom $entity): void
    {
        $em = $this->getEntityManager();
        $em->remove($entity);
        $em->flush();
    }
}
