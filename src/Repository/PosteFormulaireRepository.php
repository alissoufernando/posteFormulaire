<?php

namespace App\Repository;

use App\Entity\PosteFormulaire;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PosteFormulaire>
 *
 * @method PosteFormulaire|null find($id, $lockMode = null, $lockVersion = null)
 * @method PosteFormulaire|null findOneBy(array $criteria, array $orderBy = null)
 * @method PosteFormulaire[]    findAll()
 * @method PosteFormulaire[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PosteFormulaireRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PosteFormulaire::class);
    }

//    /**
//     * @return PosteFormulaire[] Returns an array of PosteFormulaire objects
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

//    public function findOneBySomeField($value): ?PosteFormulaire
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
