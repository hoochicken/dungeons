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
     * @param Request $request
     * @param RouteRepository $routeRepository
     * @return JsonResponse
     */
    public function place(Request $request, RouteRepository $routeRepository): JsonResponse
    {
        // get items and pagination info
        $result = $routeRepository->findByPlace($request->request->get('place'));
        $items = $routeRepository->transformAll($result['items']);

        // build return array
        return $this->respond(['items' => $items, 'info' => $result['info'], 'listState' => $result['listState']]);
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

        $out = $request->request->get('out');
        $in = $request->request->get('in');
        $direction = $request->request->get('direction');

        $route = new Route();
        $route->setOut($out);
        $route->setIn($in);
        $route->setOutDirection($direction);

        $route->setCreated(Dater::get());
        $route->setCreatedUser('ADM');

        $em->persist($route);
        $em->flush();
        $arr = $routeRepository->transform($route);
        return $this->respondCreated($arr);
    }

    /**
     * @param int $id
     * @param Request $request
     * @param RouteRepository $routeRepository
     * @param EntityManagerInterface $em
     * @return JsonResponse
     */
    public function delete($id, Request $request, RouteRepository $routeRepository, EntityManagerInterface $em): JsonResponse
    {
        $place = $routeRepository->find($id);
        if (null === $place) {
            return $this->respond('Place with id ' . $id . ' was not found. (Already removed?)');
        }
        $place->setDeleted(Dater::get());
        $place->setState(0);

        // $em->remove($place);
        $em->flush();
        return $this->respond();
    }
}
