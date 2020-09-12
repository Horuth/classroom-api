<?php

namespace App\Api\Entity\Collection;

use App\Api\Entity\ApiClassroom;
use App\Api\Entity\ApiInstanceInterface;
use Doctrine\Common\Collections\ArrayCollection;

class ApiClassroomCollection extends ArrayCollection implements ApiInstanceInterface
{
    public function toArray(): array
    {
        $array = [];

        foreach ($this->getIterator() as $element) {
            /** @var ApiClassroom $element */
            $array[] = $element->toArray();
        }

        return $array;
    }
}
