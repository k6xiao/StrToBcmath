# StrToBcmath

#### 介绍

StrToBcmath 是一个 PHP 类，用于将字符串表达式转换为 BcMath 计算结果。它支持复杂的“加、减、乘、除、指数”运算，支持括号优先级。

#### 为什么要使用这个库？

对于需要精确结果的计算，我们通常会选择使用 BcMath 来避免小数带来的误差。然而，对于复杂的计算，BcMath 的表达方式可能会显得不够直观和易读。使用这个库，你可以将直观且易读的运算表达式转换为 BcMath 的计算结果。这样，你不仅可以确保结果的精度，还能保持代码的高度可读性，节省编写代码的时间，同时避免在编写 BcMath 时可能出现的错误。

#### 安装说明

将 StrToBcmath.php 文件复制到你的项目中，并在需要使用的地方引入。

```php
require_once 'StrToBcmath.php';
```

也可以使用 `composer require k6xiao/strtobcmath` 来安装这个库，
然后使用 `use k6xiao\StrToBcmath;` 引入该库。

#### 使用说明

1.  首先，创建一个 StrToBcmath 对象。你可以在创建对象时设置精度和是否输出计算过程。

```php
// @param $scale    // 可选，精度，默认值：8
// @param $isecho   // 可选，是否输出计算过程，默认值：false
$math = new StrToBcmath();
```

2.  然后，使用 of 方法计算表达式的结果。

```php
$result = $math->of('(((2.5-3.5)+8)**(5-1)+6)/2');
// a**b 表示a的b次方
echo $result;   // 1203.50000000
```

#### 示例

以下是一些使用 StrToBcmath 的示例：

```php
// 使用书写案例
$money = 123.456;
$sxf   = 0.6;
$fee   = (new StrToBcmath(6))->of("{$money}*{$sxf}/100");
echo "{$money} 的 {$sxf}% 手续费是：{$fee}";
// 123.456 的 0.6% 手续费是：0.740736
```

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
    $result = (new StrToBcmath(6, true))->of($expression) * 1;
    echo "$expression = $result<br/><br/>";
}
```

这将输出每个表达式的计算过程和结果：

```
2*3+6+6/2
=6.000000+6+6/2
=6.000000+6+3.000000
=12.000000+3.000000
=15.000000
2*3+6+6/2 = 15

2/3
=0.666666
2/3 = 0.666666

2+3
=5.000000
2+3 = 5

2-3
=-1.000000
2-3 = -1

2-3**2
=2-9.000000
=-7.000000
2-3**2 = -7

(5-3)**2
=2.000000**2
=4.000000
(5-3)**2 = 4

2.5*3.5
=8.750000
2.5*3.5 = 8.75

2.5/3.5
=0.714285
2.5/3.5 = 0.714285

2.5+3.5
=6.000000
2.5+3.5 = 6

2.5-3.5
=-1.000000
2.5-3.5 = -1

((2.5-3.5)+8)*3
=(-1.000000+8)*3
=7.000000*3
=21.000000
((2.5-3.5)+8)*3 = 21

(((2.5-3.5)+8)*(2.5-1)+6)/2
=((-1.000000+8)*(2.5-1)+6)/2
=(7.000000*(2.5-1)+6)/2
=(7.000000*1.500000+6)/2
=16.500000/2
=8.250000
(((2.5-3.5)+8)*(2.5-1)+6)/2 = 8.25
```

#### 注意

StrToBcmath 类使用 PHP 的 bcmath 库进行计算，所以你的 PHP 环境需要支持 bcmath 库。

#### 项目源代码

你可以在以下地址找到我们的项目源代码：

- GitHub：[https://github.com/k6xiao/StrToBcmath.git](https://github.com/k6xiao/StrToBcmath.git)
- Gitee：[https://gitee.com/crazy-dream/StrToBcmath.git](https://gitee.com/crazy-dream/StrToBcmath.git)
- Composer：[https://packagist.org/packages/k6xiao/strtobcmath](https://packagist.org/packages/k6xiao/strtobcmath)

#### 项目计划

1.  增加取余运算：$num1 % $num2 ~~~ fmod(float $num1, float $num2)
2.  建立讨论组，与有兴趣的伙伴一起维护、计划