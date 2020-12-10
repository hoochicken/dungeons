<?php
namespace App\Controller;

use App\Modules\Dater;
use App\Repository\HeroClassRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Entity\Hero;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class HeroClassController extends ApiController
{

    /**
     * @param Request $request
     * @param HeroClassRepository $heroClassRepository
     * @return JsonResponse
     */
    public function list(Request $request, HeroClassRepository $heroClassRepository): JsonResponse
    {
        // retrieve data from request query
        $searchterm = trim($request->request->get('searchterm'));
        $listState = json_decode($request->request->get('listState'));
        $currentPage = $listState->currentPage ?? 0;
        $maxResult = $listState->maxResults ?? 2;

        // get items and pagination info
        $result = $heroClassRepository->findByName($searchterm, $currentPage, $maxResult);
        $items = $heroClassRepository->transformAll($result['items']);

        // build return array
        return $this->respond(['info' => $result['info'], 'items' => $items, 'listState' => $result['listState']]);
    }

    /**
     * @param Request $request
     * @param HeroClassRepository $heroClassRepository
     * @param EntityManagerInterface $em
     * @return JsonResponse
     */
    public function create(Request $request, HeroClassRepository $heroClassRepository, EntityManagerInterface $em): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $request->request->replace(is_array($data) ? $data : array());

        // validate the title
        if (! $request->get('name')) {
            return $this->respondValidationError('Please provide a name!');
        }

        // persist the new hero
        $heroClass = new Hero;
        $heroClass->setName($request->get('name'));
        $heroClass->setClass($request->get('class'));
        $heroClass->setType($request->get('type'));
        $heroClass->setDescription($request->get('description'));
        $heroClass->setPic($request->get('pic'));
        $heroClass->setLe($request->get('le'));
        $heroClass->setLeCurrent($request->get('le'));
        $heroClass->setAe($request->get('ae'));
        $heroClass->setAeCurrent($request->get('ae'));
        $heroClass->setInventory($request->get('inventory'));
        $heroClass->setWeapon($request->get('weapon'));
        $heroClass->setAt($request->get('at'));
        $heroClass->setPa($request->get('pa'));
        $heroClass->setAttributes($request->get('attributes'));
        $heroClass->setState($request->get('state'));

        $heroClass->setCreated(Dater::get());

        $em->persist($heroClass);
        $em->flush();
        return $this->respondCreated($heroClassRepository->transform($heroClass));
    }

    /**
     * @param int $id
     * @param HeroClassRepository $heroClassRepository
     * @param EntityManagerInterface $em
     * @return JsonResponse
     */
    public function get(int $id, HeroClassRepository $heroClassRepository, EntityManagerInterface $em): JsonResponse
    {
        $heroClass = $heroClassRepository->find($id);
        return $this->respondCreated($heroClassRepository->transform($heroClass));
    }

    /**
     * @param int $id
     * @param Request $request
     * @param HeroClassRepository $heroClassRepository
     * @param EntityManagerInterface $em
     * @return JsonResponse
     */
    public function update(int $id, Request $request, HeroClassRepository $heroClassRepository, EntityManagerInterface $em): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $request->request->replace(is_array($data) ? $data : array());

        // validate the title
        if (! $request->get('name')) {
            return $this->respondValidationError('Please provide a name!');
        }

        // persist the new hero
        $heroClass = $heroClassRepository->find($id);
        $heroClass->setName($request->get('name'));
        $heroClass->setClass($request->get('class'));
        $heroClass->setType($request->get('type'));
        $heroClass->setDescription($request->get('description'));
        $heroClass->setPic($request->get('pic'));
        $heroClass->setLe($request->get('le'));
        $heroClass->setLeCurrent($request->get('le_current'));
        $heroClass->setAe($request->get('ae'));
        $heroClass->setAeCurrent($request->get('ae_current'));
        $heroClass->setInventory($request->get('inventory'));
        $heroClass->setWeapon($request->get('weapon'));
        $heroClass->setAt($request->get('at'));
        $heroClass->setPa($request->get('pa'));
        $heroClass->setAttributes($request->get('attributes'));
        $heroClass->setState($request->get('state'));

        $heroClass->setUpdated(Dater::get());

        $em->persist($heroClass);
        $em->flush();
        return $this->respondCreated($heroClassRepository->transform($hero));
    }

    /**
     * @param int $id
     * @param HeroClassRepository $heroClassRepository
     * @param EntityManagerInterface $em
     * @return JsonResponse
     */
    public function delete(int $id, HeroClassRepository $heroClassRepository, EntityManagerInterface $em): JsonResponse
    {
        $heroClass = $heroClassRepository->find($id);
        if (null === $heroClass) {
            return $this->respondCreated('Hero with id ' . $id . ' was not found. (Already removed?)');
        }
        $em->remove($heroClass);
        $em->flush();
        return $this->respondCreated(true);
    }
}
