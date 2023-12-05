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
            $qb->andWhere('m.id = :user_id')
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
