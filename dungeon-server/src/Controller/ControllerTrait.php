<?php


namespace App\Controller;

use App\Repository\CategoryRepository;
use App\Repository\ItemRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
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
        $sort = $listState->sort ?? 'id';

        // get items and pagination info
        $result = $repository->findByName($searchterm, $currentPage, $maxResult, $sort);
        $entries = $repository->transformAll($result['entries']);

        // build return array
        return $this->respond(['info' => $result['info'], 'entries' => $entries, 'listState' => $result['listState']]);
    }

    /**
     * @param int $id
     * @param $repository
     * @return JsonResponse
     */
    public function get(int $id, $repository): JsonResponse
    {
        $entry = $repository->find($id);
        $entry = !is_null($entry) ? $repository->transform($entry) : $this->respondNotFound('Entry with id ' . (string) $id . ' was not found.');
        return $this->respond($entry);
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
