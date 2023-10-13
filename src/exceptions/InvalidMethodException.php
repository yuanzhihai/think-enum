<?php

namespace yuanzhihai\enum\think\exceptions;

use yuanzhihai\enum\think\Enum;
use Exception;

class InvalidMethodException extends Exception
{
    /**
     * Create an InvalidMethodException.
     *
     * @param  $invalidMethod
     * @param Enum|string $enumClass
     */
    public function __construct($invalidMethod, $enumClass)
    {
        $enumClassName = class_basename($enumClass);

        parent::__construct("Cannot found $invalidMethod method on $enumClassName class.", 405);
    }
}