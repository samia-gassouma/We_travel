<?php

namespace App\Repository;

use App\Entity\HotelName;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<HotelName>
 *
 * @method HotelName|null find($id, $lockMode = null, $lockVersion = null)
 * @method HotelName|null findOneBy(array $criteria, array $orderBy = null)
 * @method HotelName[]    findAll()
 * @method HotelName[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HotelNameRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, HotelName::class);
    }

//    /**
//     * @return HotelName[] Returns an array of HotelName objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('h')
//            ->andWhere('h.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('h.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?HotelName
//    {
//        return $this->createQueryBuilder('h')
//            ->andWhere('h.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
