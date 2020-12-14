<?php
namespace App\Controller;

use App\Entity\Category;
use App\Modules\Dater;
use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
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
     * @param string $target
     * @param Request $request
     * @param CategoryRepository $categoryRepository
     * @return JsonResponse
     */
    public function listByTarget(string $target, Request $request, CategoryRepository $categoryRepository): JsonResponse
    {
        // retrieve data from request query
        $listState = json_decode($request->request->get('listState'));
        $currentPage = $listState->currentPage ?? 0;
        $maxResult = $listState->maxResults ?? 0;

        // get items and pagination info
        $result = $categoryRepository->findByTarget($target, $currentPage, $maxResult);
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
        $category = new Category();
        $category->setName($request->get('name'));
        $category->setTarget($request->get('target'));
        $category->setDescription($request->get('description'));
        $category->setAttributes($request->get('attributes'));
        $category->setParentaux($request->get('parentaux'));
        $category->setState($request->get('state'));

        $category->setCreated(Dater::get());
        $category->setCreatedUser(0);

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
        return $this->respond($categoryRepository->transform($category));
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
        $category->setTarget($request->get('type'));
        $category->setDescription($request->get('description'));
        $category->setParentaux($request->get('parentaux'));
        $category->setAttributes($request->get('attributes'));
        $category->setState($request->get('state'));

        $category->setUpdated(Dater::get());

        $em->persist($category);
        $em->flush();
        return $this->respond($categoryRepository->transform($category));
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
            return $this->respondCreated('Category with id ' . $id . ' was not found. (Already removed?)');
        }
        $em->remove($category);
        $em->flush();
        return $this->respondCreated(true);
    }
}
