<?php

namespace app\enums;

use yuanzhihai\enum\think\contracts\LocalizedEnumContract;
use yuanzhihai\enum\think\Enum;

final class UserTypeEnum extends Enum implements LocalizedEnumContract
{
    const ADMINISTRATOR = 0;

    const MODERATOR = 1;

    const SUBSCRIBER = 2;

    const SUPER_ADMINISTRATOR = 3;

    public function magicInstantiationFromInstanceMethod(): self
    {
        return self::ADMINISTRATOR();
    }
}