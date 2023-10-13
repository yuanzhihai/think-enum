## 介绍

`think-enum` 主要用来扩展项目中的枚举使用，通过合理的定义枚举可以使代码更加规范，更易阅读和维护。
php8.1 版本后内置枚举支持，更多信息可以查看：https://www.php.net/manual/zh/language.enumerations.php

## 概览

- 扩展原生的 BackedEnum，支持多语言描述
- 提供更多种实用的方式来实例化枚举、枚举 name、value 取值
- 提供了便捷的比较方法`is`、`isNot`和`in`，用于枚举实例之间的对比
- 
## 安装
 PHP版本：php8.1+
 支持 thinkphp 8以上版本：

```shell
$ composer require yuanzhihai/think-enum -vvv
```

更为具体的使用可以查看测试用例 https://github.com/yuanzhihai/think-enum/tree/main/tests

### 常规使用

- 定义

```php
<?php

namespace app\enums;

use yuanzhihai\enum\think\support\traits\EnumEnhance;

enum UserType: int
{
    use EnumEnhance;

    case ADMINISTRATOR = 0;
    case MODERATOR = 1;
    case SUBSCRIBER = 2;
}
```

- 使用

```php
// 获取枚举的值
UserType::ADMINISTRATOR->value;// 0

// 获取所有已定义枚举的名称
$names = UserType::names();// ['ADMINISTRATOR', 'MODERATOR', 'SUBSCRIBER']

// 获取所有已定义枚举的值
$values = UserType::values();// [0, 1, 2]
```

- 枚举校验

```php
// 检查定义的枚举中是否包含某个「枚举值」
UserType::hasValue(1);// true
UserType::hasValue(-1);// false

// 检查定义的枚举中是否包含某个「枚举名称」 

UserType::hasName('MODERATOR');// true
UserType::hasName('ADMIN');// false
```
- 枚举实例化：枚举实例化以后可以方便地通过对象实例访问枚举的 key、value 以及 description 属性的值。
```php

```

- toArray

```php

$array = UserType::toArray();

```

- toSelectArray

```php
$array = UserType::toSelectArray();// 支持多语言配置

/*
[
    0 => '管理员',
    1 => '监督员',
    2 => '订阅用户',
]
*/
```


