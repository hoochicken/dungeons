<?php

namespace App\Repository;

use App\Entity\Hero;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\ORM\Tools\Setup;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Hero|null find($id, $lockMode = null, $lockVersion = null)
 * @method Hero|null findOneBy(array $criteria, array $orderBy = null)
 * @method Hero[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HeroRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Hero::class);
    }

    /**
     * @param $value
     * @param int $currentPage
     * @param int $maxResults
     * @return Hero[] Returns an array of Hero objects
     */
    public function findByName($value, int $currentPage = 0, int $maxResults = 0)
    {
        $firstResult = $maxResults * $currentPage;
        $qb = $this->createQueryBuilder('h');

        if (false && !empty($value)) {
            $qb->andWhere('h.name LIKE :val')
                ->setParameter('val', '%' . $value . '%');
        }

        $qb->setFirstResult($firstResult)
            ->setMaxResults($maxResults)
            ->orderBy('h.id', 'ASC');

        $query = $qb->getQuery();
        $items = $query->getResult();

        /*
        $em = $this->getEntityManager() ;
        $sql = 'SELECT * FROM hero;';
        $statement = $em->getConnection()->prepare($sql);
        $statement->execute();
        $info = $statement->fetchAll();
        */

        return ['info' => '', 'items' => $items, 'listState' => $this->getListState($query, $maxResults, $firstResult, $currentPage)];
    }

    /**
     * @return Hero[] Returns an array of Hero objects
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


    /*
    public function findOneBySomeField($value): ?Hero
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function transform(Hero $hero)
    {
        return [
            'id'    => (int) $hero->getId(),
            'name' => (string) $hero->getName(),
            'class' => (string) $hero->getClass(),
            'type' => (string) $hero->getType(),
            'description' => (string) $hero->getDescription(),
            'pic' => (string) $hero->getPic(),
            'le' => (int) $hero->getLe(),
            'le_current' => (int) $hero->getLeCurrent(),
            'ae' => (int) $hero->getAe(),
            'ae_current' => (int) $hero->getAeCurrent(),
            'inventory' => (string) $hero->getInventory(),
            'weapon' => (int) $hero->getWeapon(),
            'at' => (int) $hero->getAt(),
            'pa' => (int) $hero->getPa(),
            'attributes' => (string) $hero->getAttributes(),
            'state' => (int) $hero->getState(),
        ];
    }

    public function transformAll($heros)
    {
        $herosArray = [];
        foreach ($heros as $hero) {
            $herosArray[] = $this->transform($hero);
        }
        return $herosArray;
    }

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
    //  * @return Hero[] Returns an array of Hero objects
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
    public function findOneBySomeField($value): ?Hero
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
