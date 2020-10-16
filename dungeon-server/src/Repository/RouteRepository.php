<?php

namespace App\Repository;

use App\Entity\Place;
use App\Entity\Route;
use App\Modules\Dater;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\BrowserKit\Request;

/**
 * @method Route|null find($id, $lockMode = null, $lockVersion = null)
 * @method Route|null findOneBy(array $criteria, array $orderBy = null)
 * @method Route[]    findAll()
 * @method Route[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RouteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Route::class);
    }

    // /**
    //  * @return Route[] Returns an array of Route objects
    //  */
    public function findByPlace($value)
    {
        return $this->createQueryBuilder('r')
            ->where('r.out = :val')
            ->orWhere('r.in = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getResult()
        ;
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

    /**
     * @param Route $route
     * @return array
     */
    public function transform(Route $route)
    {
        $return = [];
        $return['id'] = $route->getId();
        $return['out'] = $route->getOut();
        $return['in'] = $route->getIn();
        $return['out_direction'] = $route->getOutDirection();
        $return['attributes'] = $route->getAttributes();
        $return['state'] = $route->getState();
        return $return;
    }
}
