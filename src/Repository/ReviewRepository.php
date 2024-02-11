<?php

namespace App\Repository;

use App\Entity\Review;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Review>
 *
 * @method Review|null find($id, $lockMode = null, $lockVersion = null)
 * @method Review|null findOneBy(array $criteria, array $orderBy = null)
 * @method Review[]    findAll()
 * @method Review[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReviewRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Review::class);
    }

    public function deleteReviewById(string $id): bool
    {
        $review = $this->find($id);
        if ($review) {
            $this->_em->remove($review);
            $this->_em->flush();
            return true;
        }
        return false;
    }

    public function processReviewById(string $id): bool
    {
        $review = $this->find($id);
        if ($review) {
            $review->setProcessed(true);
            $this->_em->flush();
            return true;
        }
        return false;
    }

}
