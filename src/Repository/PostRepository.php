<?php

namespace App\Repository;

use App\Entity\Post;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Doctrine\ORM\QueryBuilder;

/**
 * @method Post|null find($id, $lockMode = null, $lockVersion = null)
 * @method Post|null findOneBy(array $criteria, array $orderBy = null)
 * @method Post[]    findAll()
 * @method Post[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PostRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Post::class);
    }


    /**
     * Helper method -> return query builder with default isActive = true
     *
     * @param QueryBuilder|null $queryBuilder
     * @return QueryBuilder
     */
    private function addIsPublishedQueryBuilder(QueryBuilder $queryBuilder = null)
    {
        return $this->getOrCreateQueryBuilder($queryBuilder)
//            ->leftJoin('p.category', 'c')
//            ->addSelect('c')
            ->andWhere('p.isActive = :val')
            ->setParameter('val', true);
    }


    /**
     * Helper method -> create new or return existing query builder object
     *
     * @param QueryBuilder|null $queryBuilder
     * @return QueryBuilder
     */
    private function getOrCreateQueryBuilder(?QueryBuilder $queryBuilder)
    {
        return $queryBuilder ?: $this->createQueryBuilder('p');
    }

    /**
     * Get all published posts ordered by newest
     */
    public function findAllPublishedOrderedByNewest()
    {
        return $this->addIsPublishedQueryBuilder()
            ->orderBy('p.createdAt', 'DESC')
            ->getQuery()
            ->getResult();
    }

    /**
     * Get all published * promoted posts
     */
    public function findAllPublishedAndPromoted()
    {
        return $this->addIsPublishedQueryBuilder()
            ->andWhere('p.isPromoted = :val')
            ->setParameter('val', true)
            ->getQuery()
            ->getResult();
    }

}
