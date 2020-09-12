<?php

namespace App\Core\Builder;

use App\Core\Entity\Classroom;

class ClassroomBuilder
{
    public function buildClassroom(string $name): Classroom
    {
        $classroom = new Classroom();
        $classroom->setName($name);
        $classroom->setCreationDate(new \DateTime());
        $classroom->setIsActive(true);

        return $classroom;
    }
}
