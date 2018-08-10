<?php

namespace App\Resources;

use Sensorario\Resources\Resource;

class SomeObject
    extends Resource
    implements \JsonSerializable
{
    public function mandatory()
    {
        return [
            'foo',
            'bar',
        ];
    }

    public function jsonSerialize()
    {
        return $this->properties();
    }
}
