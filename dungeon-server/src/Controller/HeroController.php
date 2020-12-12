<?php
namespace App\Controller;

use App\Modules\Dater;
use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Entity\Hero;
use App\Repository\HeroRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class HeroController extends ApiController
{

    /**
     * @param Request $request
     * @param HeroRepository $heroRepository
     * @return JsonResponse
     */
    public function list(Request $request, HeroRepository $heroRepository): JsonResponse
    {
        // retrieve data from request query
        $searchterm = trim($request->request->get('searchterm'));
        $listState = json_decode($request->request->get('listState'));
        $currentPage = $listState->currentPage ?? 0;
        $maxResult = $listState->maxResults ?? 2;

        // get items and pagination info
        $result = $heroRepository->findByName($searchterm, $currentPage, $maxResult);
        $items = $heroRepository->transformAll($result['items']);

        // build return array
        return $this->respond(['info' => $result['info'], 'items' => $items, 'listState' => $result['listState']]);
    }

    /**
     * @param string $type
     * @param Request $request
     * @param HeroRepository $heroRepository
     * @return JsonResponse
     */
    public function listByType(string $type, Request $request, HeroRepository $heroRepository): JsonResponse
    {
        // retrieve data from request query
        $listState = json_decode($request->request->get('listState'));
        $currentPage = $listState->currentPage ?? 0;
        $maxResult = $listState->maxResults ?? 0;

        // get items and pagination info
        $result = $heroRepository->findByType($type, $currentPage, $maxResult);
        $items = $heroRepository->transformAll($result['items']);

        // build return array
        return $this->respond(['info' => $result['info'], 'items' => $items, 'listState' => $result['listState']]);
    }

    /**
     * @param Request $request
     * @param HeroRepository $heroRepository
     * @param CategoryRepository $categoryRepository
     * @param EntityManagerInterface $em
     * @return JsonResponse
     */
    public function create(Request $request, HeroRepository $heroRepository, CategoryRepository $categoryRepository, EntityManagerInterface $em): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        // return $this->respond((array) $request);
        $request->request->replace(is_array($data) ? $data : array());

        // validate the title
        if (! $request->get('name')) {
            return $this->respondValidationError('Please provide a name!');
        }

        // persist the new hero
        $hero = new Hero;
        $hero->setName($request->get('name'));
        $hero->setCategory($categoryRepository->find($request->get('category')));
        $hero->setType($request->get('type'));
        $hero->setDescription($request->get('description'));
        $hero->setPic($request->get('pic'));
        $hero->setLe($request->get('le'));
        $hero->setLeCurrent($request->get('le'));
        $hero->setAe($request->get('ae'));
        $hero->setAeCurrent($request->get('ae'));
        $hero->setInventory($request->get('inventory'));
        $hero->setWeapon($request->get('weapon'));
        $hero->setAt($request->get('at'));
        $hero->setPa($request->get('pa'));
        $hero->setAttributes($request->get('attributes'));
        $hero->setState($request->get('state'));

        $hero->setCreated(Dater::get());

        $em->persist($hero);
        $em->flush();
        return $this->respondCreated($heroRepository->transform($hero));
    }

    /**
     * @param int $id
     * @param HeroRepository $heroRepository
     * @param EntityManagerInterface $em
     * @return JsonResponse
     */
    public function get(int $id, HeroRepository $heroRepository, EntityManagerInterface $em): JsonResponse
    {
        $hero = $heroRepository->find($id);
        return $this->respondCreated($heroRepository->transform($hero));
    }

    /**
     * @param int $id
     * @param Request $request
     * @param HeroRepository $heroRepository
     * @param CategoryRepository $categoryRepository
     * @param EntityManagerInterface $em
     * @return JsonResponse
     */
    public function update(int $id, Request $request, HeroRepository $heroRepository, CategoryRepository $categoryRepository, EntityManagerInterface $em): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $request->request->replace(is_array($data) ? $data : array());

        // validate the title
        if (! $request->get('name')) {
            return $this->respondValidationError('Please provide a name!');
        }

        // persist the new hero
        $hero = $heroRepository->find($id);
        $hero->setName($request->get('name'));
        $hero->setCategory($categoryRepository->find($request->get('category')));
        $hero->setType($request->get('type'));
        $hero->setDescription($request->get('description'));
        $hero->setPic($request->get('pic'));
        $hero->setLe($request->get('le'));
        $hero->setLeCurrent($request->get('le_current'));
        $hero->setAe($request->get('ae'));
        $hero->setAeCurrent($request->get('ae_current'));
        $hero->setInventory($request->get('inventory'));
        $hero->setWeapon($request->get('weapon'));
        $hero->setAt($request->get('at'));
        $hero->setPa($request->get('pa'));
        $hero->setAttributes($request->get('attributes'));
        $hero->setState($request->get('state'));

        $hero->setUpdated(Dater::get());

        $em->persist($hero);
        $em->flush();
        return $this->respondCreated($heroRepository->transform($hero));
    }

    /**
     * @param int $id
     * @param Request $request
     * @param HeroRepository $heroRepository
     * @param EntityManagerInterface $em
     * @return JsonResponse
     */
    public function delete(int $id, Request $request, HeroRepository $heroRepository, EntityManagerInterface $em): JsonResponse
    {
        $hero = $heroRepository->find($id);
        if (null === $hero) {
            return $this->respondCreated('Hero with id ' . $id . ' was not found. (Already removed?)');
        }
        $em->remove($hero);
        $em->flush();
        return $this->respondCreated(true);
    }

    /**
     * @param Request $request
     * @param EntityManagerInterface $em
     * @param HeroRepository $heroRepository
     * @return JsonResponse
     */
    public function decrease(Request $request, EntityManagerInterface $em, HeroRepository $heroRepository)
    {
        $request = Request::createFromGlobals();
        $id = (int) $request->request->get('id');
        $hero = $heroRepository->find($id);

        if (!$hero) {
            return $this->respondNotFound(sprintf('The hero entity witrh the id %s could not be found', $id));
        }

        $hero->setLeCurrent($hero->getLeCurrent() - 1);
        $em->persist($hero);
        $em->flush();

        return $this->respond([
            'le_current' => $hero->getLeCurrent()
        ]);
    }
}
