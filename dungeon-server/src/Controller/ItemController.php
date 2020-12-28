<?php
namespace App\Controller;

use App\Modules\Dater;
use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Entity\Item;
use App\Repository\ItemRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ItemController extends ApiController
{

    use ControllerTrait {
        delete as protected traitDelete;
        listIt as protected traitList;
        get as protected traitGet;
    }

    /**
     * @param Request $request
     * @param ItemRepository $itemRepository
     * @return JsonResponse
     */
    public function list(Request $request, ItemRepository $itemRepository): JsonResponse
    {
        return $this->traitList($request, $itemRepository);
    }

    /**
     * @param Request $request
     * @param ItemRepository $itemRepository
     * @param EntityManagerInterface $em
     * @return JsonResponse
     */
    public function create(Request $request, ItemRepository $itemRepository, EntityManagerInterface $em): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        // return $this->respond((array) $request);
        $request->request->replace(is_array($data) ? $data : array());

        // validate the title
        if (! $request->get('name')) {
            return $this->respondValidationError('Please provide a name!');
        }

        // persist the new item
        $item = new Item;
        $item->setName($request->get('name'));
        $item->setDescription($request->get('description'));
        $item->setWorth($request->get('worth'));
        $item->setWeight($request->get('weight'));
        $item->setPic($request->get('pic'));
        $item->setAttributes($request->get('attributes'));
        $item->setState($request->get('state'));

        $item->setCreated(Dater::get());

        $em->persist($item);
        $em->flush();
        return $this->respondCreated($itemRepository->transform($item));
    }

    /**
     * @param int $id
     * @param ItemRepository $itemRepository
     * @param EntityManagerInterface $em
     * @return JsonResponse
     */
    public function get(int $id, ItemRepository $itemRepository, CategoryRepository $categoryRepository, EntityManagerInterface $em): JsonResponse
    {
        return $this->traitGet($id, $itemRepository, $categoryRepository, $em);
    }

    /**
     * @param int $id
     * @param Request $request
     * @param ItemRepository $itemRepository
     * @param EntityManagerInterface $em
     * @return JsonResponse
     */
    public function update(int $id, Request $request, ItemRepository $itemRepository, EntityManagerInterface $em): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $request->request->replace(is_array($data) ? $data : array());

        // validate the title
        if (! $request->get('name')) {
            return $this->respondValidationError('Please provide a name!');
        }

        // persist the new item
        $item = $itemRepository->find($id);
        $item->setName($request->get('name'));
        $item->setDescription($request->get('description'));
        $item->setWeight($request->get´('weight'));
        $item->setWorth($request->get('worth'));
        $item->setPic($request->get('pic'));
        $item->setAttributes($request->get('attributes'));
        $item->setState($request->get('state'));

        $item->setUpdated(Dater::get());

        $em->persist($item);
        $em->flush();
        return $this->respond($itemRepository->transform($item));
    }

    /**
     * @param int $id
     * @param ItemRepository $itemRepository
     * @param EntityManagerInterface $em
     * @return JsonResponse
     */
    public function delete(int $id, ItemRepository $itemRepository, EntityManagerInterface $em): JsonResponse
    {
        return $this->traitDelete($id, $itemRepository, $em);
    }
}
