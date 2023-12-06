<?php

namespace App\Repository;

use App\Entity\Teste;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Teste>
 *
 * @method Teste|null find($id, $lockMode = null, $lockVersion = null)
 * @method Teste|null findOneBy(array $criteria, array $orderBy = null)
 * @method Teste[]    findAll()
 * @method Teste[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TesteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Teste::class);
    }
    
    
    public function filterTeste($label, $userId): array
    {
        $qb = $this->createQueryBuilder('m');

        if ($userId) {
            $qb->andWhere('m.user = :user_id')
            ->setParameter('user_id', $userId);
        }

        if ($label) {
            $qb->andWhere('m.label LIKE :inLanguage')
            ->setParameter('inLanguage', '%'.$label.'%');
        }

        return $qb->getQuery()->getResult();
    }

    public function findById($id): ?Teste
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.id = :inLanguage')
            ->setParameter('inLanguage', $id)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

    public function findPopularTests($hours = 24, $maxResult = 6, $minTentative = 1)
    {
        $qb = $this->createQueryBuilder('t')
            ->leftJoin('t.tentatives', 'tentatives')
            ->groupBy('t.id')
            ->having('COUNT(tentatives.id) >= :minTentatives')
            ->andWhere('tentatives.dateTentative >= :lastHours')
            ->orderBy('COUNT(tentatives.id)', 'DESC')
            ->setParameter('minTentatives', $minTentative ) 
            ->setParameter('lastHours', new \DateTime("-$hours hours"))
            ->setMaxResults($maxResult);

        return $qb->getQuery()->getResult();
    }

    public function findLastCreatedTests($maxResult = 6)
    {
        $qb = $this->createQueryBuilder('t')
            ->orderBy('t.id', 'DESC')
            ->setMaxResults($maxResult);

        return $qb->getQuery()->getResult();
    }

    public function findByUser($userId) : array {
        $qb = $this->createQueryBuilder('m');
        $qb->andWhere('m.user = :user_id')
            ->setParameter('user_id', $userId);

        return $qb->getQuery()->getResult();
    }

//    /**
//     * @return Teste[] Returns an array of Teste objects
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

//    public function findOneBySomeField($value): ?Teste
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
