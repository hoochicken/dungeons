<?php

namespace App\Repository;

use App\Entity\Category;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Category|null find($id, $lockMode = null, $lockVersion = null)
 * @method Category|null findOneBy(array $criteria, array $orderBy = null)
 * @method Category[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Category::class);
    }

    /**
     * @param $value
     * @param int $currentPage
     * @param int $maxResults
     * @return Category[] Returns an array of Category objects
     */
    public function findByName($value, int $currentPage = 0, int $maxResults = 0)
    {
        $firstResult = $this->getFirstResult($maxResults, $currentPage);
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
        $info = 'sql:' . $query->getDQL();
        return ['info' => $info, 'items' => $items, 'listState' => $this->getListState($query, $maxResults, $firstResult, $currentPage)];
    }

    /**
     * @param $target
     * @param int $currentPage
     * @param int $maxResults
     * @return Category[] Returns an array of Category objects
     */
    public function findByTarget($target, int $currentPage = 0, int $maxResults = 0)
    {
        $maxResults = 20; $currentPage = 0;
        $firstResult = $this->getFirstResult($maxResults, $currentPage);
        $qb = $this->createQueryBuilder('h');

        if (!empty($target)) {
            $qb->andWhere('h.target = :target')
                ->setParameter('target', $target);
        }

        $qb->setFirstResult($firstResult)
            ->setMaxResults($maxResults)
            ->orderBy('h.id', 'ASC');

        $query = $qb->getQuery();
        $items = $query->getResult();
        $info = 'target:' . $target . '; sql:' . $query->getDQL() . ';';
        return ['info' => $info, 'items' => $items, 'listState' => $this->getListState($query, $maxResults, $firstResult, $currentPage)];
    }

    /**
     * @return Category[] Returns an array of Category objects
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

    public function transform(Category $category)
    {
        return [
            'id'    => (int) $category->getId(),
            'name' => (string) $category->getName(),
            'target' => (string) $category->getTarget(),
            'parentaux' => (string) $category->getParentaux(),
            'description' => (string) $category->getDescription(),
            'attributes' => (string) $category->getAttributes(),
            'state' => (string) $category->getState(),
            'created' => $category->getCreated(),
        ];
    }

    /**
     * @param $heros
     * @return array
     */
    public function transformAll($heros)
    {
        $categoryArray = [];
        foreach ($heros as $category) {
            $categoryArray[] = $this->transform($category);
        }
        return $categoryArray;
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

    private function getFirstResult($maxResults, $currentPage)
    {
        return $maxResults * $currentPage;
    }

    // /**
    //  * @return Category[] Returns an array of Category objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Category
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
