<?php

namespace App\Repository;

use App\Entity\HeroClass;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method HeroClass|null find($id, $lockMode = null, $lockVersion = null)
 * @method HeroClass|null findOneBy(array $criteria, array $orderBy = null)
 * @method HeroClass[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HeroClassRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, HeroClass::class);
    }

    /**
     * @param $value
     * @param int $currentPage
     * @param int $maxResults
     * @return HeroClass[] Returns an array of HeroClass objects
     */
    public function findByName($value, int $currentPage = 0, int $maxResults = 0)
    {
        $firstResult = $maxResults * $currentPage;
        $qb = $this->createQueryBuilder('h');

        if (!empty($value)) {
            $qb->andWhere('h.name LIKE :val')
                ->setParameter('val', '%' . $value . '%');
        }

        $qb->setFirstResult($firstResult)
            ->setMaxResults($maxResults)
            ->orderBy('h.id', 'ASC');

        $query = $qb->getQuery();
        $items = $query->getResult();
        return ['info' => '', 'items' => $items, 'listState' => $this->getListState($query, $maxResults, $firstResult, $currentPage)];
    }

    /**
     * @return HeroClass[] Returns an array of Hero objects
     */
    public function findAll()
    {
        $qb = $this->createQueryBuilder('h')
            ->orderBy('h.id', 'ASC')
            ->setFirstResult((int) 0)
            ->setMaxResults(3)
        ;
        $query = $qb->getQuery();
        return $query->getResult();
    }

    /**
     * @param QueryBuilder $qb
     * @param $firstResult
     * @param $maxResult
     * @return Paginator
     */
    function paginate(QueryBuilder $qb, $firstResult, $maxResult)
    {
        $qb->setFirstResult((int) $firstResult)
            ->setMaxResults((int) $maxResult);

        $paginator = new Paginator($qb->getQuery(), true);

        return $paginator;
    }

    public function transform(HeroClass $heroClass)
    {
        return [
            'id'    => (int) $heroClass->getId(),
            'name' => (string) $heroClass->getName(),
            'attributes' => (string) $heroClass->getAttributes(),
            'state' => (string) $heroClass->getState(),
            'description' => (string) $heroClass->getLabel(),
        ];
    }

    /**
     * @param $heros
     * @return array
     */
    public function transformAll($heros)
    {
        $heroClassArray = [];
        foreach ($heros as $heroClass) {
            $heroClassArray[] = $this->transform($heroClass);
        }
        return $heroClassArray;
    }

    /**
     * @param $query
     * @param $maxResults
     * @param $firstResult
     * @param $currentPage
     * @return array
     */
    public function getListState($query, $maxResults, $firstResult, $currentPage)
    {
        // load doctrine Paginator
        $paginator = new Paginator($query);

        // you can get total items
        $totalItems = count($paginator);

        // get total pages
        $totalPage = $maxResults > 0 ? ceil($totalItems / $maxResults) : $totalItems;

        // now get one page's items:
        $paginator
            ->getQuery()
            ->setFirstResult($firstResult) // set the offset
            ->setMaxResults($maxResults);

        $listState = [
            'currentPage' => $currentPage,
            'maxResults' => $maxResults,
            'totalPage' => $totalPage,
            'firstResult' => $firstResult,
            'totalItems' => $totalItems,
        ];
        return $listState;
    }

    // /**
    //  * @return HeroClass[] Returns an array of HeroClass objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('h.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?HeroClass
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
