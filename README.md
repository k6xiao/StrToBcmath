# StrToBcmath

#### 介绍
StrToBcmath 是一个 PHP 类，用于将字符串表达式转换为 BcMath 计算结果。它支持复杂的“加、减、乘、除、指数”运算，支持括号优先级+++。

#### 安装教程

将 StrToBcmath.php 文件复制到你的项目中，并在需要使用的地方引入。

```php
require_once 'StrToBcmath.php';
```

#### 使用说明

1.  首先，创建一个 StrToBcmath 对象。你可以在创建对象时设置精度和是否输出计算过程。

```php
// @param $scale    // 可选，精度，默认值：8
// @param $isecho   // 可选，是否输出计算过程，默认值：false
$bcmath = new StrToBcmath();
```

2.  然后，使用 main 方法计算表达式的结果。

```php
$result = $bcmath->main('(((2.5-3.5)+8)*(2.5-1)+6)/2');
```

#### 示例

以下是一些使用 StrToBcmath 的示例：

```php
require_once 'StrToBcmath.php';

// 定义一些表达式
$expressions = [
    '2*3+6+6/2',
    '2/3',
    '2+3',
    '2-3',
    '2-3**2',
    '(5-3)**2',
    '2.5*3.5',
    '2.5/3.5',
    '2.5+3.5',
    '2.5-3.5',
    '((2.5-3.5)+8)*3',
    '(((2.5-3.5)+8)*(2.5-1)+6)/2',
];

// 计算每个表达式的结果
foreach ($expressions as $expression) {
    $result = (new StrToBcmath(6, true))->main($expression) * 1;
    echo "$expression = $result<hr/>";
}
```

这将输出每个表达式的计算结果。

#### 注意

StrToBcmath 类使用 PHP 的 bcmath 库进行计算，所以你的 PHP 环境需要支持 bcmath 库。

#### 参与贡献

1.  Fork 本仓库
2.  新建 Feat_xxx 分支
3.  提交代码
4.  新建 Pull Request