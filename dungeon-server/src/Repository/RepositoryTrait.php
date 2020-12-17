<?php


namespace App\Repository;


use Doctrine\ORM\Tools\Pagination\Paginator;

trait RepositoryTrait
{
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

    /**
     * @param array $items
     * @return array
     */
    public function transformAll(array $items)
    {
        $return = [];
        foreach($items as $item) {
            $return[] = $this->transform($item);
        }
        return $return;
    }

    public function findByName($value, int $currentPage = 0, int $maxResults = 0)
    {
        $firstResult = $maxResults * $currentPage;
        $qb = $this->createQueryBuilder('h');

        if (!empty($value) && 3 <= strlen($value)) {
            $qb->andWhere('h.name LIKE :val')
                ->setParameter('val', '%' . $value . '%');
        }

        $qb->setFirstResult($firstResult);

        if (0 < $maxResults) {
            $qb->setMaxResults($maxResults);
        }
        $qb->orderBy('h.id', 'ASC');

        $query = $qb->getQuery();
        $items = $query->getResult();
        return ['info' => $maxResults, 'items' => $items, 'listState' => $this->getListState($query, $maxResults, $firstResult, $currentPage)];
    }
}
