<?php

namespace App\Repository;

use App\Entity\Category;
use App\Entity\Item;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\VarExporter\Internal\Registry;

/**
 * @method Item|null find($id, $lockMode = null, $lockVersion = null)
 * @method Item|null findOneBy(array $criteria, array $orderBy = null)
 * @method Item[]    findAll()
 * @method Item[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ItemRepository extends ServiceEntityRepository
{

    use RepositoryTrait;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Item::class);
    }

    /**
     * @param Item $item
     * @return array
     */
    public function transform(Item $item)
    {
        $return = [];
        $return['id'] = $item->getId();
        $return['name'] = $item->getName();
        $return['description'] = $item->getDescription();
        $return['category'] = is_null($item->getCategory()) ? null : $item->getCategory()->getId();
        $return['categoryName'] = is_null($item->getCategory()) ? null : $item->getCategory()->getName();
        $return['weight'] = $item->getWeight();
        $return['worth'] = $item->getWorth();
        $return['attributes'] = $item->getAttributes();
        // $return['itemtype'] = $item->getItemtype();
        $return['pic'] = $item->getPic();
        $return['state'] = $item->getState();
        return $return;
    }

    // /**
    //  * @return Item[] Returns an array of Item objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Item
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
