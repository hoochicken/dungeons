<?php
namespace App\Controller;

use App\Modules\Dater;
use mysql_xdevapi\Exception;
use phpDocumentor\Reflection\DocBlock\Tags\Example;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Entity\Place;
use App\Repository\PlaceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PlaceController extends ApiController
{

    /**
     * @param Request $request
     * @param PlaceRepository $placeRepository
     * @return JsonResponse
     */
    public function list(Request $request, PlaceRepository $placeRepository): JsonResponse
    {
        // retrieve data from request query
        $searchterm = trim($request->request->get('searchterm'));
        $listState = json_decode($request->request->get('listState'));
        $currentPage = $listState->currentPage ?? 0;
        $maxResult = $listState->maxResults ?? 2;

        // get items and pagination info
        $result = $placeRepository->findByName($searchterm, $currentPage, $maxResult);
        $items = $placeRepository->transformAll($result['items']);

        // build return array
        return $this->respond(['items' => $items, 'info' => $result['info'], 'listState' => $result['listState']]);
    }

    /**
     * @param Request $request
     * @param PlaceRepository $placeRepository
     * @param EntityManagerInterface $em
     * @return JsonResponse
     */
    public function create(Request $request, PlaceRepository $placeRepository, EntityManagerInterface $em): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $request->request->replace(is_array($data) ? $data : array());

        // validate the title
        if (! $request->get('name')) {
            return $this->respondValidationError('Please provide a name!');
        }

        // persist the new place
        $place = new Place;
        $place->setName($request->get('name'));
        $place->setDescription($request->get('description'));
        $place->setPic($request->get('pic'));
        $place->setMisc($request->get('misc'));
        $place->setState($request->get('state'));
        $place->setCreated(Dater::get());

        $em->persist($place);
        $em->flush();
        $arr = $placeRepository->transform($place);
        return $this->respondCreated($arr);
    }

    /**
     * @param int $id
     * @param PlaceRepository $placeRepository
     * @param EntityManagerInterface $em
     * @return JsonResponse
     */
    public function get(int $id, PlaceRepository $placeRepository, EntityManagerInterface $em): JsonResponse
    {
        try {
            $place = $placeRepository->find($id);
            if (!is_object($place)) {
                throw new \ErrorException(sprintf('The place width the id \'%s\' could not be found.', $id));
            }
            return $this->respond($placeRepository->transform($place));
        } catch (\Exception $e) {
            return $this->respondNotFound($e->getMessage());
        }
    }

    /**
     * @param int $id
     * @param Request $request
     * @param PlaceRepository $placeRepository
     * @param EntityManagerInterface $em
     * @return JsonResponse
     */
    public function update(int $id, Request $request, PlaceRepository $placeRepository, EntityManagerInterface $em): JsonResponse
    {
        // return $this->respondCreated([1,2,3,4]);
        $data = json_decode($request->getContent(), true);
        $request->request->replace(is_array($data) ? $data : array());

        // validate the title
        if (! $request->get('name')) {
            return $this->respondValidationError('Please provide a name!');
        }

        // persist the new place
        $place = $placeRepository->find($id);
        $place->setName($request->get('name'));
        $place->setDescription($request->get('description'));
        $place->setPic($request->get('pic'));
        $place->setMisc($request->get('misc'));
        $place->setState($request->get('state'));
        $place->setUpdated(Dater::get());
        $em->persist($place);
        $em->flush();
        return $this->respond($placeRepository->transform($place));
    }

    /**
     * @param int $id
     * @param Request $request
     * @param PlaceRepository $placeRepository
     * @param EntityManagerInterface $em
     * @return JsonResponse
     */
    public function delete($id, Request $request, PlaceRepository $placeRepository, EntityManagerInterface $em): JsonResponse
    {
        $place = $placeRepository->find($id);
        if (null === $place) {
            return $this->respond('Place with id ' . $id . ' was not found. (Already removed?)');
        }
        $place->setDeleted(Dater::get());
        $place->setState(false);

        // $em->remove($place);
        $em->flush();
        return $this->respond();
    }
}
