<?php

namespace App\Repository;

use App\Entity\Place;
use App\Entity\Route;
use App\Modules\Dater;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
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
    const DIRECTION_MOM = 10;
    const DIRECTION_MIDDLE_BUTTON_INDEX = 5;
    private static $DIRECTION_1 = 'NW';
    private static $DIRECTION_2 = 'N';
    private static $DIRECTION_3 = 'NE';
    private static $DIRECTION_4 = 'W';
    private static $DIRECTION_5 = 'C';
    private static $DIRECTION_6 = 'E';
    private static $DIRECTION_7 = 'SW';
    private static $DIRECTION_8 = 'S';
    private static $DIRECTION_9 = 'SE';

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Route::class);
    }

    // /**
    //  * @return Route[] Returns an array of Route objects
    //  */
    public function findById($id, $debug = false)
    {
        $query = $this->createQueryBuilder('r')
            ->where('r.id = :id')
            ->andWhere('r.state = 1')
            ->setParameter('id', $id)
            ->getQuery()
        ;
        if ($debug) return $query = $query->getSQL();
        return $query->getResult();
    }

    // /**
    //  * @return Route[] Returns an array of Route objects
    //  */
    public function findByPlace($place, $debug = false)
    {
        $query = $this->createQueryBuilder('r')
            ->where('r.placeOut = :place')
            ->orWhere('r.placeIn = :place')
            ->andWhere('r.state = 1')
            ->setParameter('place', $place)
            ->getQuery()
        ;
        if ($debug) return $query = $query->getSQL();
        return $query->getResult();
    }

    // /**
    //  * @return Route[] Returns an array of Route objects
    //  */
    public function getRouteToPlaceByDirection($place, $direction, $debug = false)
    {
        $reverseDirection = $this->getReverseDirection($direction);
        $query = $this->createQueryBuilder('r')
            ->where('r.outDirection = :strictDirection AND r.placeIn = :place')
            ->orWhere('r.outDirection = :reverseDirection AND r.placeOut = :place')
            ->andWhere('r.state = 1')
            ->setParameter('reverseDirection', $reverseDirection)
            ->setParameter('strictDirection', $direction)
            ->setParameter('place', $place)
            ->getQuery();

        if ($debug) return $query->getSQL();
        return $query->getResult();
    }

    /**
     * returns value of reverse direction
     * @param $direction
     * @return int
     * @throws \Exception
     */
    public function getReverseDirection($direction)
    {
        if (5 === $direction) {
            throw new \Exception('Direction of 5 is irreversable');
        }
        return self::DIRECTION_MOM - $direction;
    }

    /**
     * @param int $placeId
     * @param array $items
     * @return array
     */
    public function unifyRoutesAll(int $placeId, array $items)
    {
        $unifiedAll = [];
        foreach($items as $item) {
            $unified = $this->unifyRoute($placeId, $item);
            $tmpDirection = $unified['out_direction'];
            $unifiedAll[$tmpDirection] = $unified;
        }

        $default = [
            'id' => 0,
            'place_out_id' => $placeId,
            'place_in_id' => 0,
            'out_direction' => 0,
            'type' => 'btn',
        ];

        $routes = [];
        foreach (range(1,9) as $direction) {
            $routes[$direction] = $default;
            $routes[$direction]['out_direction'] = $direction;
            if (!isset($unifiedAll[$direction])) continue;
            $routes[$direction] = $unifiedAll[$direction];
        }
        // middle button is center
        $routes[self::DIRECTION_MIDDLE_BUTTON_INDEX]['type'] = 'center';
        return $routes;
    }

    /**
     * @return array
     */
    public function getDirections()
    {
        $default = [
            'id' => 0,
            'place_out_id' => 0,
            'place_in_id' => 0,
            'out_direction' => 0,
            'label' => '',
            'type' => 'btn'
        ];

        $routes = [];
        foreach (range(1,9) as $direction) {
            $routes[$direction] = $default;
            $routes[$direction]['out_direction'] = $direction;
            $constant = 'DIRECTION_' . $direction;
            $routes[$direction]['label'] = self::$$constant;
        }
        // middle button is center
        $routes[self::DIRECTION_MIDDLE_BUTTON_INDEX]['type'] = 'center';
        return $routes;
    }

    /**
     * @param int $placeId
     * @param array $item
     * @return array
     */
    public function unifyRoute(int $placeId, array $item)
    {
        // if place out correct => return original array
        if ($placeId == $item['place_out_id']) {
            return $item;
        }
        // if now, reverse routing
        $return = $item;

        // swap in and out places
        $return['place_out_id'] = $item['place_in_id'];
        $return['place_in_id'] = $item['place_out_id'];
        $return['out_direction'] = 10 - (int) $item['out_direction'];
        return $return;
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
        $return['place_out_id'] = is_null($route->getPlaceOut()) ? null : $route->getPlaceOut()->getId();
        $return['place_out_name'] = is_null($route->getPlaceOut()) ? null : $route->getPlaceOut()->getName();
        $return['place_in_id'] = is_null($route->getPlaceIn()) ? null : $route->getPlaceIn()->getId();
        $return['place_in_name'] = is_null($route->getPlaceIn()) ? null : $route->getPlaceIn()->getName();
        $return['out_direction'] = $route->getOutDirection();
        $return['attributes'] = $route->getAttributes();
        $return['state'] = $route->getState();
        return $return;
    }

    /**
     * @param $query
     * @return mixed
     */
    private function getSql(QueryBuilder $query)
    {
        return $query->prepare(Yii::$app->db->queryBuilder)->createCommand()->rawSql;
    }
}
