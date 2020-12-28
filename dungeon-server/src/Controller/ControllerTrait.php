<?php


namespace App\Controller;

use App\Repository\CategoryRepository;
use App\Repository\ItemRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

trait ControllerTrait
{
    /**
     * @param Request $request
     * @param $repository
     * @return JsonResponse
     */
    public function listIt(Request $request, $repository): JsonResponse
    {
        // retrieve data from request query
        $searchterm = trim($request->request->get('searchterm'));
        $listState = json_decode($request->request->get('listState'));
        $currentPage = $listState->currentPage ?? 0;
        $maxResult = $listState->maxResults ?? 2;

        // get items and pagination info
        $result = $repository->findByName($searchterm, $currentPage, $maxResult);
        $items = $repository->transformAll($result['items']);

        // build return array
        return $this->respond(['info' => $result['info'], 'items' => $items, 'listState' => $result['listState']]);
    }

    /**
     * @param int $id
     * @param $repository
     * @param CategoryRepository $categoryRepository
     * @param EntityManagerInterface $em
     * @return JsonResponse
     */
    public function get(int $id, $repository, CategoryRepository $categoryRepository, EntityManagerInterface $em): JsonResponse
    {
        $item = $repository->find($id);
        $item->setCategory($categoryRepository->find($item->getCategory()));
        return $this->respond($repository->transform($item));
    }

    /**
     * @param int $id
     * @param $repository
     * @param EntityManagerInterface $em
     * @return JsonResponse
     */
    public function delete(int $id, $repository, EntityManagerInterface $em): JsonResponse
    {
        $item = $repository->find($id);
        if (null === $item) {
            return $this->respondCreated('Entry with id ' . $id . ' was not found. (Already removed?)');
        }
        $em->remove($item);
        $em->flush();
        return $this->respond(true);
    }
}
