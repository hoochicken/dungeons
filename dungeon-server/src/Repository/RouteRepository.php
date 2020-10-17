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
        $query = $this->createQueryBuilder('r')
            ->where('r.placeOut = :val')
            ->orWhere('r.placeIn = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getResult()
        ;
        // $query = $query->getSQL();
        return $query;
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
        $return['place_out'] = $route->getPlaceOut();
        $return['place_in'] = $route->getPlaceIn();
        $return['out_direction'] = $route->getOutDirection();
        $return['attributes'] = $route->getAttributes();
        $return['state'] = $route->getState();
        return $return;
    }
}
