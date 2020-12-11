<?php
namespace App\Controller;

use App\Modules\Dater;
use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Entity\Hero;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends ApiController
{

    /**
     * @param Request $request
     * @param CategoryRepository $categoryRepository
     * @return JsonResponse
     */
    public function list(Request $request, CategoryRepository $categoryRepository): JsonResponse
    {
        // retrieve data from request query
        $searchterm = trim($request->request->get('searchterm'));
        $listState = json_decode($request->request->get('listState'));
        $currentPage = $listState->currentPage ?? 0;
        $maxResult = $listState->maxResults ?? 2;

        // get items and pagination info
        $result = $categoryRepository->findByName($searchterm, $currentPage, $maxResult);
        $items = $categoryRepository->transformAll($result['items']);

        // build return array
        return $this->respond(['info' => $result['info'], 'items' => $items, 'listState' => $result['listState']]);
    }

    /**
     * @param Request $request
     * @param CategoryRepository $categoryRepository
     * @param EntityManagerInterface $em
     * @return JsonResponse
     */
    public function create(Request $request, CategoryRepository $categoryRepository, EntityManagerInterface $em): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $request->request->replace(is_array($data) ? $data : array());

        // validate the title
        if (! $request->get('name')) {
            return $this->respondValidationError('Please provide a name!');
        }

        // persist the new hero
        $category = new Hero;
        $category->setName($request->get('name'));
        $category->setClass($request->get('class'));
        $category->setType($request->get('type'));
        $category->setDescription($request->get('description'));
        $category->setPic($request->get('pic'));
        $category->setLe($request->get('le'));
        $category->setLeCurrent($request->get('le'));
        $category->setAe($request->get('ae'));
        $category->setAeCurrent($request->get('ae'));
        $category->setInventory($request->get('inventory'));
        $category->setWeapon($request->get('weapon'));
        $category->setAt($request->get('at'));
        $category->setPa($request->get('pa'));
        $category->setAttributes($request->get('attributes'));
        $category->setState($request->get('state'));

        $category->setCreated(Dater::get());

        $em->persist($category);
        $em->flush();
        return $this->respondCreated($categoryRepository->transform($category));
    }

    /**
     * @param int $id
     * @param CategoryRepository $categoryRepository
     * @param EntityManagerInterface $em
     * @return JsonResponse
     */
    public function get(int $id, CategoryRepository $categoryRepository, EntityManagerInterface $em): JsonResponse
    {
        $category = $categoryRepository->find($id);
        return $this->respondCreated($categoryRepository->transform($category));
    }

    /**
     * @param int $id
     * @param Request $request
     * @param CategoryRepository $categoryRepository
     * @param EntityManagerInterface $em
     * @return JsonResponse
     */
    public function update(int $id, Request $request, CategoryRepository $categoryRepository, EntityManagerInterface $em): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $request->request->replace(is_array($data) ? $data : array());

        // validate the title
        if (! $request->get('name')) {
            return $this->respondValidationError('Please provide a name!');
        }

        // persist the new hero
        $category = $categoryRepository->find($id);
        $category->setName($request->get('name'));
        $category->setClass($request->get('class'));
        $category->setType($request->get('type'));
        $category->setDescription($request->get('description'));
        $category->setPic($request->get('pic'));
        $category->setLe($request->get('le'));
        $category->setLeCurrent($request->get('le_current'));
        $category->setAe($request->get('ae'));
        $category->setAeCurrent($request->get('ae_current'));
        $category->setInventory($request->get('inventory'));
        $category->setWeapon($request->get('weapon'));
        $category->setAt($request->get('at'));
        $category->setPa($request->get('pa'));
        $category->setAttributes($request->get('attributes'));
        $category->setState($request->get('state'));

        $category->setUpdated(Dater::get());

        $em->persist($category);
        $em->flush();
        return $this->respondCreated($categoryRepository->transform($hero));
    }

    /**
     * @param int $id
     * @param CategoryRepository $categoryRepository
     * @param EntityManagerInterface $em
     * @return JsonResponse
     */
    public function delete(int $id, CategoryRepository $categoryRepository, EntityManagerInterface $em): JsonResponse
    {
        $category = $categoryRepository->find($id);
        if (null === $category) {
            return $this->respondCreated('Hero with id ' . $id . ' was not found. (Already removed?)');
        }
        $em->remove($category);
        $em->flush();
        return $this->respondCreated(true);
    }
}
