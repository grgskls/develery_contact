<?php

namespace App\Repository;

use App\Entity\ContactQuestion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ContactQuestion>
 *
 * @method ContactQuestion|null find($id, $lockMode = null, $lockVersion = null)
 * @method ContactQuestion|null findOneBy(array $criteria, array $orderBy = null)
 * @method ContactQuestion[]    findAll()
 * @method ContactQuestion[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ContactQuestionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ContactQuestion::class);
    }

//    /**
//     * @return ContactQuestion[] Returns an array of ContactQuestion objects
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

//    public function findOneBySomeField($value): ?ContactQuestion
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
