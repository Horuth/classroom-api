<?php

namespace App\Api\Facade;

use App\Api\Bridge\ClassroomBridge;
use App\Api\Entity\ApiClassroom;
use App\Api\Entity\Collection\ApiClassroomCollection;
use App\Api\Service\ClassroomRequestHandlerService;
use App\Api\Validator\ClassroomRequestValidator;
use App\Core\Builder\ClassroomBuilder;
use App\Core\Repository\ClassroomRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ClassroomCreateFacade
{
    /** @var ClassroomRepository $classroomRepository */
    private $classroomRepository;

    /** @var ClassroomBuilder $classroomBuilder */
    private $classroomBuilder;

    /** @var ClassroomRequestValidator $classroomRequestValidator */
    private $classroomRequestValidator;

    /** @var ClassroomRequestHandlerService $classroomRequestHandlerService */
    private $classroomRequestHandlerService;

    /** @var ClassroomBridge $classroomBridge */
    private $classroomBridge;

    public function __construct(
        ClassroomRepository $classroomRepository,
        ClassroomBuilder $classroomBuilder,
        ClassroomRequestValidator $classroomRequestValidator,
        ClassroomRequestHandlerService $classroomRequestHandlerService,
        ClassroomBridge $classroomBridge
    ) {
        $this->classroomRepository = $classroomRepository;
        $this->classroomBuilder = $classroomBuilder;
        $this->classroomRequestValidator = $classroomRequestValidator;
        $this->classroomRequestHandlerService = $classroomRequestHandlerService;
        $this->classroomBridge = $classroomBridge;
    }

    public function create(Request $request): ApiClassroom
    {
        $this->classroomRequestValidator->validateClassroomRequest($request);

        $this->classroomRequestHandlerService->setRequest($request);
        $name = $this->classroomRequestHandlerService->getValueName();

        $classroom = $this->classroomBuilder->buildClassroom($name);
        $this->classroomRepository->save($classroom);

        return $this->classroomBridge->classroomFromCoreToApi($classroom);
    }

    public function get(int $id): ApiClassroom
    {
        $classroom = $this->classroomRepository->find($id);
        if (!$classroom) {
            throw new NotFoundHttpException();
        }

        return $this->classroomBridge->classroomFromCoreToApi($classroom);
    }

    public function getAll(): ApiClassroomCollection
    {
        $classroomList = $this->classroomRepository->findAllActive();

        return $this->classroomBridge->classroomListFromCoreToApi($classroomList);
    }

    public function update(int $id, Request $request): ApiClassroom
    {
        $classroom = $this->classroomRepository->find($id);
        if (!$classroom) {
            throw new NotFoundHttpException();
        }
        $this->classroomRequestValidator->validateClassroomRequest($request);

        $this->classroomRequestHandlerService->setRequest($request);
        $name = $this->classroomRequestHandlerService->getValueName();

        $classroom->setName($name);
        $this->classroomRepository->save($classroom);

        return $this->classroomBridge->classroomFromCoreToApi($classroom);
    }

    public function delete(int $id): void
    {
        $classroom = $this->classroomRepository->find($id);
        if (!$classroom) {
            throw new NotFoundHttpException();
        }

        $classroom->setIsActive(false);
        $this->classroomRepository->save($classroom);
    }
}
