<?php

namespace App\Repository;

use App\Entity\Car;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Car>
 *
 * @method Car|null find($id, $lockMode = null, $lockVersion = null)
 * @method Car|null findOneBy(array $criteria, array $orderBy = null)
 * @method Car[]    findAll()
 * @method Car[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CarRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Car::class);
    }

    public function deleteById(int $id): bool
    {
        $qb = $this->createQueryBuilder('s')
            ->delete()
            ->andWhere('s.id = :id')
            ->setParameter('id', $id)
            ->getQuery();

        return $qb->execute();
    }

    public function findByFilters(array $filters): array
    {
        $qb = $this->createQueryBuilder('s');

        foreach ($filters as $key => $value) {
            if (array_key_exists('inf', $value) && array_key_exists('sup', $value)) {
                $qb->andWhere('s.' . $key . ' >= :' . $key . 'Inf')
                    ->andWhere('s.' . $key . ' <= :' . $key . 'Sup')
                    ->setParameter($key . 'Inf', $value['inf'])
                    ->setParameter($key . 'Sup', $value['sup']);
            } else {
                // We have only one
                if (array_key_exists('inf', $value)) {
                    $qb->andWhere('s.' . $key . ' >= :' . $key)
                        ->setParameter($key, $value['inf']);
                }
                if (array_key_exists('sup', $value)) {
                    $qb->andWhere('s.' . $key . ' <= :' . $key)
                        ->setParameter($key, $value['sup']);
                }
            }
        }

        return $qb->getQuery()->getResult();
    }
}
