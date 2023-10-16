## 介绍

`think-enum` 主要用来扩展项目中的枚举使用，通过合理的定义枚举可以使代码更加规范，更易阅读和维护。

## 概览

- 提供了多种实用的方式来实例化枚举
- 支持多语言本地化描述
- 支持路由中间件自动将 Request 参数转换成相应枚举实例
- 提供了便捷的比较方法`is`、`isNot`和`in`，用于枚举实例之间的对比
- 内置了多种实用的枚举集：
 - 标准的 Http 状态码枚举定义，方便在 API 返回响应数据时设置 Http 状态码；
- 
## 安装
 支持 thinkphp 6以上版本：

```shell
$ composer require yuanzhihai/think-enum v1
```

### 配置项说明
```php
// config/enum.php

return [
    'localization' => [
        'key' => env('ENUM_LOCALIZATION_KEY', 'enums'),// app/lang/zh-cn/enums.php  语言包文件名
    ]
];

```

更为具体的使用可以查看测试用例 https://github.com/yuanzhihai/think-enum/tree/main/tests

### 常规使用

- 定义

```php
<?php

namespace app\enums;

use yuanzhihai\enum\think\Enum;

final class UserTypeEnum extends Enum
{
    const ADMINISTRATOR = 0;

    const MODERATOR = 1;

    const SUBSCRIBER = 2;

    const SUPER_ADMINISTRATOR = 3;
}
```

- 使用

```php
// 获取常量的值
UserTypeEnum::ADMINISTRATOR;// 0

// 获取所有已定义常量的名称
$keys = UserTypeEnum::getKeys();// ['ADMINISTRATOR', 'MODERATOR', 'SUBSCRIBER', 'SUPER_ADMINISTRATOR']

// 根据常量的值获取常量的名称
UserTypeEnum::getKey(1);// MODERATOR

// 获取所有已定义常量的值
$values = UserTypeEnum::getValues();// [0, 1, 2, 3]

// 根据常量的名称获取常量的值
UserTypeEnum::getValue('MODERATOR');// 1
```

- 本地化描述
```php
// 1. 不存在语言包的情况，返回较为友好的英文描述
UserTypeEnum::getDescription(UserTypeEnum::ADMINISTRATOR);// Administrator

// 2. 在 app/lang/zh-cn.php 
ExampleEnum::getDescription(ExampleEnum::ADMINISTRATOR);// 管理员

// 补充：也可以先实例化常量对象，然后再根据对象实例来获取常量描述
$responseEnum = new ExampleEnum(ExampleEnum::ADMINISTRATOR);
$responseEnum->description;// 管理员

// 其他方式
ExampleEnum::ADMINISTRATOR()->description;// 管理员
```
- 枚举校验

```php
// 检查定义的常量中是否包含某个「常量值」
UserTypeEnum::hasValue(1);// true
UserTypeEnum::hasValue(-1);// false

// 检查定义的常量中是否包含某个「常量名称」 

UserTypeEnum::hasKey('MODERATOR');// true
UserTypeEnum::hasKey('ADMIN');// false
```


- 枚举实例化：枚举实例化以后可以方便地通过对象实例访问枚举的 key、value 以及 description 属性的值。

```php
// 方式一：new 传入常量的值
$administrator1 = new UserTypeEnum(UserTypeEnum::ADMINISTRATOR);

// 方式二：fromValue
$administrator2 = UserTypeEnum::fromValue(0);

// 方式三：fromKey
$administrator3 = UserTypeEnum::fromKey('ADMINISTRATOR');

// 方式四：magic
$administrator4 = UserTypeEnum::ADMINISTRATOR();

// 方式五：make，尝试根据「常量的值」或「常量的名称」实例化对象常量，实例失败时返回原先传入的值
$administrator5 = UserTypeEnum::make(0); // 此处尝试根据「常量的值」实例化
$administrator6 = UserTypeEnum::make('ADMINISTRATOR'); // 此处尝试根据「常量的名称」实例化
```
- 枚举实例化进阶：（TransfrormEnums 中间件自动转换请求参数为枚举实例，使用的便是下面的 make 方法）

```php
$administrator2 = UserTypeEnum::make('ADMINISTRATOR');// strict 默认为 true；准备被实例化

$administrator3 = UserTypeEnum::make(0);// strict 默认为 true；准备被实例化

// 注意：这里的 0 是字符串类型，而原先定义的是数值类型
$administrator4 = UserTypeEnum::make('0', false); // strict 设置为 false，不校验传入值的类型；会被准确实例化

// 注意：这里的 AdminiStrator 是大小写混乱的
$administrator6 = UserTypeEnum::make('AdminiStrator', false); // strict 设置为 false，不校验传入值的大小写；会被准确实例化
```
- 随机获取

```php
// 随机获取一个常量的值
UserTypeEnum::getRandomValue();

// 随机获取一个常量的名称
UserTypeEnum::getRandomKey();

// 随机获取一个枚举实例
UserTypeEnum::getRandomInstance()
```

- toArray

```php

$array = UserTypeEnum::toArray();
/*
[
    'ADMINISTRATOR' => 0,
    'MODERATOR' => 1,
    'SUBSCRIBER' => 2,
    'SUPER_ADMINISTRATOR' => 3,
]
*/

```

- toSelectArray

```php
$array = UserType::toSelectArray();// 支持多语言配置

/*
[
    0 => '管理员',
    1 => '监督员',
    2 => '订阅用户',
    3 => '超级管理员',
]
*/
```


