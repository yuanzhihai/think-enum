<?php

use app\enums\UserTypeEnum;

return [
    UserTypeEnum::class => [
        UserTypeEnum::ADMINISTRATOR       => '管理员',
        UserTypeEnum::SUPER_ADMINISTRATOR => '超级管理员',
        UserTypeEnum::MODERATOR           => '监督员',
        UserTypeEnum::SUBSCRIBER          => '订阅用户',
    ],
];