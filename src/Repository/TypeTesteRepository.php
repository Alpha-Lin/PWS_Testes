<?php

namespace App\Repository;

use App\Entity\TypeTeste;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TypeTeste>
 *
 * @method TypeTeste|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeTeste|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeTeste[]    findAll()
 * @method TypeTeste[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeTesteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypeTeste::class);
    }

//    /**
//     * @return TypeTeste[] Returns an array of TypeTeste objects
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

//    public function findOneBySomeField($value): ?TypeTeste
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
