<?php

namespace App\Api\Validator;

use App\Api\Service\ClassroomRequestHandlerService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class ClassroomRequestValidator
{
    /** @var ClassroomRequestHandlerService $classroomRequestHandlerService */
    private $classroomRequestHandlerService;

    public function __construct(ClassroomRequestHandlerService $classroomRequestHandlerService)
    {
        $this->classroomRequestHandlerService = $classroomRequestHandlerService;
    }

    public function validateClassroomRequest(Request $request): void
    {
        $this->classroomRequestHandlerService->setRequest($request);

        if (!$this->classroomRequestHandlerService->getValueName()) {
            throw new BadRequestHttpException();
        }
    }
}
