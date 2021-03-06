<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\ORM\EntityRepository;

/**
 * ParkRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ParkRepository extends EntityRepository
{
    /**
     * @param User $user
     * @return mixed
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function countForUser(User $user)
    {
        return $this->getEntityManager()
            ->createQueryBuilder()
            ->select('count(DISTINCT(p.id))')
            ->from('App:RiddenCoaster', 'r')
            ->join('r.coaster', 'c')
            ->join('c.park', 'p')
            ->where('r.user = :user')
            ->setParameter('user', $user)
            ->getQuery()
            ->getSingleScalarResult();
    }

    /**
     * @return mixed
     */
    public function findAllForSearch()
    {
        return $this->getEntityManager()
            ->createQueryBuilder()
            ->select('p.name')
            ->addSelect('p.slug')
            ->from('App:Park', 'p')
            ->getQuery()
            ->getResult();
    }
}
