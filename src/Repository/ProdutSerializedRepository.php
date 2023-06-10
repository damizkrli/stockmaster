<?php

namespace App\Repository;

use App\Entity\ProdutSerialized;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ProdutSerialized>
 *
 * @method ProdutSerialized|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProdutSerialized|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProdutSerialized[]    findAll()
 * @method ProdutSerialized[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProdutSerializedRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProdutSerialized::class);
    }

    public function save(ProdutSerialized $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(ProdutSerialized $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return ProdutSerialized[] Returns an array of ProdutSerialized objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ProdutSerialized
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
