<?php

namespace App\Api\Controller;

use App\Api\Facade\ClassroomCreateFacade;
use App\Api\Factory\ClassroomResponseFactory;
use App\Core\Repository\ClassroomRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClassroomController
{
    /** @var ClassroomRepository $classroomRepository */
    private $classroomRepository;

    /** @var ClassroomCreateFacade $createFacade */
    private $classroomCreateFacade;

    /** @var ClassroomResponseFactory $classroomResponseFactory */
    private $classroomResponseFactory;

    public function __construct(
        ClassroomRepository $classroomRepository,
        ClassroomCreateFacade $classroomCreateFacade,
        ClassroomResponseFactory $classroomResponseFactory
    ) {
        $this->classroomRepository = $classroomRepository;
        $this->classroomCreateFacade = $classroomCreateFacade;
        $this->classroomResponseFactory = $classroomResponseFactory;
    }

    /**
     * @Route("/classrooms/", name="add_classroom", methods={"POST"})
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function create(Request $request): JsonResponse
    {
        try {
            $apiClassroom = $this->classroomCreateFacade->create($request);
        } catch (\Throwable $exception) {
            return $this->classroomResponseFactory->createErrorResponse($exception);
        }

        return $this->classroomResponseFactory->createSuccessResponse($apiClassroom, Response::HTTP_CREATED);
    }

    /**
     * @Route("/classrooms/{id}", name="get_classroom", methods={"GET"})
     * @param int $id
     *
     * @return JsonResponse
     */
    public function get(int $id): JsonResponse
    {
        try {
            $apiClassroom = $this->classroomCreateFacade->get($id);
        } catch (\Throwable $exception) {
            return $this->classroomResponseFactory->createErrorResponse($exception);
        }

        return $this->classroomResponseFactory->createSuccessResponse($apiClassroom, Response::HTTP_OK);
    }

    /**
     * @Route("/classrooms/", name="get_all_classrooms", methods={"GET"})
     *
     * @return JsonResponse
     */
    public function getAll(): JsonResponse
    {
        try {
            $apiClassroomCollection = $this->classroomCreateFacade->getAll();
        } catch (\Throwable $exception) {
            return $this->classroomResponseFactory->createErrorResponse($exception);
        }

        return $this->classroomResponseFactory->createSuccessResponse($apiClassroomCollection, Response::HTTP_OK);
    }

    /**
     * @Route("/classrooms/{id}", name="update_classroom", methods={"PATCH"})
     * @param int $id
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function update(int $id, Request $request): JsonResponse
    {
        try {
            $apiClassroom = $this->classroomCreateFacade->update($id, $request);
        } catch (\Throwable $exception) {
            return $this->classroomResponseFactory->createErrorResponse($exception);
        }

        return $this->classroomResponseFactory->createSuccessResponse($apiClassroom, Response::HTTP_ACCEPTED);
    }

    /**
     * @Route("/classrooms/{id}", name="delete_classroom", methods={"DELETE"})
     * @param int $id
     *
     * @return JsonResponse
     */
    public function delete(int $id): JsonResponse
    {
        try {
            $this->classroomCreateFacade->delete($id);
        } catch (\Throwable $exception) {
            return $this->classroomResponseFactory->createErrorResponse($exception);
        }

        return $this->classroomResponseFactory->createSuccessResponse(null, Response::HTTP_ACCEPTED);
    }
}
