<?php

namespace App\Repository;

use App\Entity\Hotels;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\QueryBuilder; // Import de QueryBuilder

class HotelsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Hotels::class);
    }

    public function search($searchTerm)
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.name LIKE :searchTerm')
            ->setParameter('searchTerm', '%'.$searchTerm.'%')
            ->getQuery()
            ->getResult();
    }

    public function findAllOrderedBy($sortBy)
    {
        $qb = $this->createQueryBuilder('h');
        if ($sortBy === 'rating') {
            $qb->orderBy('h.rating', 'DESC');
        } else {
            $qb->orderBy('h.name', 'ASC');
        }
        return $qb->getQuery()->getResult();
    }
}
