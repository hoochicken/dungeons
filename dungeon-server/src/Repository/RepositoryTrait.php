<?php


namespace App\Repository;


use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Tools\Pagination\Paginator;
use JetBrains\PhpStorm\ArrayShape;

trait RepositoryTrait
{
    /**
     * @param $query
     * @param $maxResults
     * @param $firstResult
     * @param $currentPage
     * @param $sort
     * @return array
     */
    public function getListState($query, $maxResults, $firstResult, $currentPage, $sort)
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
            'sort' => $sort,
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

    public function findByName($value, int $currentPage = 0, int $maxResults = 0, $sort = 'id')
    {
        $firstResult = $maxResults * $currentPage;
        /** @var QueryBuilder $qb */
        $qb = $this->createQueryBuilder('h');

        if (!empty($value) && 3 <= strlen($value) && 'undefined' !== $value) {
            $qb->andWhere('h.name LIKE :val')
                ->setParameter('val', '%' . $value . '%');
        }

        $qb->setFirstResult($firstResult);

        if (0 < $maxResults) {
            $qb->setMaxResults($maxResults);
        }
        $sort = $this->getSort($sort);
        $order = $sort['order'] ?? 'id';
        $dir = $sort['dir'] ?? 'ASC';
        $qb->orderBy('h.' . $order ?? 'id', $dir);

        $query = $qb->getQuery();
        $items = $query->getResult();
        return ['info' => $value . '#' . json_encode($sort) . '#' . $query->getDQL(), 'entries' => $items, 'listState' => $this->getListState($query, $maxResults, $firstResult, $currentPage, $order)];
    }

    /**
     * @param $sort
     * @return array #[ArrayShape(['sort' => "mixed|string", 'dir' => "string"])]
     */
    private function getSort($sort): array
    {
        $direction = '-' === substr($sort, 0, 1) ? 'DESC' : 'ASC';
        $order = !empty($sort) ? preg_replace('~([^0-9a-zA-Z]*)~','', $sort) : 'id';
        return ['order' => $order, 'dir' => $direction];
    }
}
