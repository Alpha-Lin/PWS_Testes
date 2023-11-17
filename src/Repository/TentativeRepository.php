<?php

namespace App\Repository;

use App\Entity\Tentative;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Tentative>
 *
 * @method Tentative|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tentative|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tentative[]    findAll()
 * @method Tentative[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TentativeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tentative::class);
    }

//    /**
//     * @return Tentative[] Returns an array of Tentative objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('t.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Tentative
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
