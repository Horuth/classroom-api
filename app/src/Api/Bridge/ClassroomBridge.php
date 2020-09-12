<?php

namespace App\Api\Bridge;

use App\Api\Entity\ApiClassroom;
use App\Api\Entity\Collection\ApiClassroomCollection;
use App\Core\Entity\Classroom;

class ClassroomBridge
{
    public function classroomFromCoreToApi(Classroom $classroom): ApiClassroom
    {
        $apiClassroom = new ApiClassroom();
        $apiClassroom->setId($classroom->getId());
        $apiClassroom->setName($classroom->getName());
        $apiClassroom->setCreationDate($classroom->getCreationDate());
        $apiClassroom->setIsActive($classroom->getIsActive());

        return $apiClassroom;
    }

    public function classroomListFromCoreToApi(array $classroomList): ApiClassroomCollection
    {
        $apiClassroomCollection = new ApiClassroomCollection();

        foreach ($classroomList as $classroom) {
            $apiClassroomCollection->add($this->classroomFromCoreToApi($classroom));
        }

        return $apiClassroomCollection;
    }
}
