<?php

namespace App\Repository;

use App\Entity\CritereSolution;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CritereSolution>
 *
 * @method CritereSolution|null find($id, $lockMode = null, $lockVersion = null)
 * @method CritereSolution|null findOneBy(array $criteria, array $orderBy = null)
 * @method CritereSolution[]    findAll()
 * @method CritereSolution[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CritereSolutionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CritereSolution::class);
    }

//    /**
//     * @return CritereSolution[] Returns an array of CritereSolution objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?CritereSolution
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
