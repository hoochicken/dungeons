<?php
namespace App\Controller;

use App\Entity\Route;
use App\Modules\Dater;
use App\Repository\RouteRepository;
use mysql_xdevapi\Exception;
use phpDocumentor\Reflection\DocBlock\Tags\Example;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Entity\Place;
use App\Repository\PlaceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class RouteController extends ApiController
{

    /**
     * @param int $place
     * @param RouteRepository $routeRepository
     * @return JsonResponse
     */
    public function place(int $place, RouteRepository $routeRepository): JsonResponse
    {
        $debug = false;

        // get items and pagination info
        $result = $routeRepository->findByPlace($place, $debug);
        if ($debug) return $this->respond(['items' => $result]);
        $routesRaw = $routeRepository->transformAll($result);
        $routes = $routeRepository->unifyRoutesAll($place, $routesRaw);

        // build return array
        return $this->respond(['items' => $routes]);
    }

    /**
     * @param Request $request
     * @param RouteRepository $routeRepository
     * @param EntityManagerInterface $em
     * @return JsonResponse
     */
    public function create(Request $request, RouteRepository $routeRepository, EntityManagerInterface $em): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $request->request->replace(is_array($data) ? $data : array());

        $placeOut = $request->request->get('place_out', 0);
        $placeIn = $request->request->get('place_in', 0);
        $direction = $request->request->get('out_direction', 0);

        $route = new Route();

        $route->setPlaceOut($placeOut);
        $route->setPlaceIn($placeIn);
        $route->setOutDirection($direction);

        $route->setCreated(Dater::get());
        $route->setCreatedUser(0);

        $em->persist($route);
        $em->flush();
        $arr = $routeRepository->transform($route);
        // return $this->respondCreated(['route' => $routeRepository->transform($route)]);
        return $this->respondCreated($arr);
    }

    /**
     * @param int $id
     * @param RouteRepository $routeRepository
     * @param EntityManagerInterface $em
     * @return JsonResponse
     */
    public function delete($id, RouteRepository $routeRepository, EntityManagerInterface $em): JsonResponse
    {
        $route = $routeRepository->find($id);
        if (null === $route) {
            return $this->respond('Route with id ' . $id . ' was not found. (Already removed?)');
        }
        $route->setDeleted(Dater::get());
        $route->setState(0);
        $em->remove($route);
        $em->flush();
        return $this->respond(['delete' => true]);
    }


    /**
     * @param int $id
     * @param Request $request
     * @param RouteRepository $routeRepository
     * @param EntityManagerInterface $em
     * @return JsonResponse
     */
    public function update($id, Request $request, RouteRepository $routeRepository, EntityManagerInterface $em): JsonResponse
    {
        $route = $routeRepository->find($id);
        if (null === $route) {
            return $this->respond('Route with id ' . $id . ' was not found. (Already removed?)');
        }
        $data = json_decode($request->getContent(), true);
        $request->request->replace(is_array($data) ? $data : array());

        $placeOut = $request->request->get('place_out', 0);
        $placeIn = $request->request->get('place_in', 0);

        $route = $routeRepository->find($id);
        $route->setPlaceOut($placeOut);
        $route->setPlaceIn($placeIn);

        $em->persist($route);
        $em->flush();
        $arr = $routeRepository->transform($route);

        return $this->respond($arr);
    }

    /**
     * @param $place
     * @param $direction
     * @param RouteRepository $routeRepository
     * @param EntityManagerInterface $em
     * @return JsonResponse
     */
    public function routeToPlaceExists($place, $direction, RouteRepository $routeRepository, EntityManagerInterface $em): JsonResponse
    {
        $route = $routeRepository->getRouteToPlace($place, $direction);
        $exists = 0 < count($route);
        $data = [
            'place' => $place,
            'direction' => $direction,
            'exists' => $exists,
            'route' => $routeRepository->transformAll($route),
        ];
        return $this->respond($data);
    }

    /**
     * @param int $id
     * @param Request $request
     * @param RouteRepository $routeRepository
     * @param EntityManagerInterface $em
     * @return JsonResponse
     */
    public function deletePlace($id, Request $request, RouteRepository $routeRepository, EntityManagerInterface $em): JsonResponse
    {
        $place = $routeRepository->find($id);
        if (null === $place) {
            return $this->respond('Place with id ' . $id . ' was not found. (Already removed?)');
        }
        $place->setDeleted(Dater::get());
        $place->setState(0);

        // $em->remove($place);
        $em->flush();
        return $this->respond(['delete' => true]);
    }
}
