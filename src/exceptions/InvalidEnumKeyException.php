<?php

namespace yuanzhihai\enum\think\exceptions;

use yuanzhihai\enum\think\Enum;

class InvalidEnumKeyException extends \Exception
{
    /**
     * Create an InvalidEnumKeyException.
     *
     * @param mixed $invalidKey
     * @param Enum|string $enumClass
     * @return void
     */
    public function __construct($invalidKey, $enumClass)
    {
        $invalidKeyType = gettype($invalidKey);
        $enumKeys       = implode(', ', $enumClass::getKeys());
        $enumClassName  = class_basename($enumClass);

        parent::__construct("Cannot construct an instance of $enumClassName using the key ($invalidKeyType) `$invalidKey`. Possible keys are [$enumKeys].");
    }
}