<?php

namespace App\Repository;

use App\Entity\Service;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Service>
 *
 * @method Service|null find($id, $lockMode = null, $lockVersion = null)
 * @method Service|null findOneBy(array $criteria, array $orderBy = null)
 * @method Service[]    findAll()
 * @method Service[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ServiceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Service::class);
    }

    public function findAllServices(): array
    {
        $qb = $this->createQueryBuilder('s')
            ->orderBy('s.name', 'ASC')
            ->getQuery();

        return $qb->execute();
    }

    public function findServiceById(int $id): ?Service
    {
        $qb = $this->createQueryBuilder('s')
            ->andWhere('s.id = :id')
            ->setParameter('id', $id)
            ->getQuery();

        return $qb->getOneOrNullResult();
    }

    public function deleteServiceById(int $id): bool
    {
        $qb = $this->createQueryBuilder('s')
            ->delete()
            ->andWhere('s.id = :id')
            ->setParameter('id', $id)
            ->getQuery();

        return $qb->execute();
    }
}
