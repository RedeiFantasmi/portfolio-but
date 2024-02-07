<?php

namespace App\Repository;

use App\Entity\ButSkill;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ButSkill>
 *
 * @method ButSkill|null find($id, $lockMode = null, $lockVersion = null)
 * @method ButSkill|null findOneBy(array $criteria, array $orderBy = null)
 * @method ButSkill[]    findAll()
 * @method ButSkill[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ButSkillRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ButSkill::class);
    }

//    /**
//     * @return ButSkill[] Returns an array of ButSkill objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('b.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ButSkill
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
