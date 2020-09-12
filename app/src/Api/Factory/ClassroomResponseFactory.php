<?php

namespace App\Api\Factory;

use App\Api\Bridge\ClassroomBridge;
use App\Api\Entity\ApiInstanceInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Throwable;

class ClassroomResponseFactory
{
    /** @var ClassroomBridge $classroomBridge */
    private $classroomBridge;

    public function __construct(ClassroomBridge $classroomBridge)
    {
        $this->classroomBridge = $classroomBridge;
    }

    public function createSuccessResponse(?ApiInstanceInterface $apiInstance, int $status): JsonResponse
    {
        return new JsonResponse($apiInstance ? $apiInstance->toArray() : null, $status);
    }

    public function createErrorResponse(Throwable $throwable): JsonResponse
    {
        if ($throwable instanceof HttpException) {
            return new JsonResponse(null, $throwable->getStatusCode());
        }

        return new JsonResponse($throwable->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}
