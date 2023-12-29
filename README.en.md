# StrToBcmath

#### Description

StrToBcmath is a PHP class that converts string expressions into BcMath evaluations. It supports complex "addition, subtraction, multiplication, division, exponential" operations and supports parenthesis precedence.

#### Why use this library?

For calculations that require precise results, we usually choose to use BcMath to avoid errors caused by decimals. However, for complex calculations, the expression of BcMath may not be intuitive and easy to read. By using this library, you can convert intuitive and easy-to-read operation expressions into BcMath calculation results. In this way, you can not only ensure the accuracy of the results, but also maintain a high readability of the code, save time in writing code, and avoid possible errors when writing BcMath.

#### Software Architecture

Copy the StrToBcmath.php file into your project and bring it in where you need to use it.

```php
require_once 'StrToBcmath.php';
```

#### Instructions for use

1. First, create a StrToBcmath object. You can set the precision and whether or not to output the calculation process when you create the object.

```php
@param $scale // Optional, Accuracy, Default: 8
@param $isecho // Optional, whether to output the calculation process, default value: false
$bcmath = new StrToBcmath();
```

2. Then, use the main method to calculate the result of the expression.

```php
$result = $bcmath->main('(((2.5-3.5)+8)**(5-1)+6)/2');
// a**b represents a to the power of b
echo $result;   // 1203.50000000
```

#### example

Here are some examples of using StrToBcmath:

```php
require_once 'StrToBcmath.php';

Define some expressions
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

Evaluates the result of each expression
foreach ($expressions as $expression) {
    $result = (new StrToBcmath(6, true))->main($expression) * 1;
    echo "$expression = $result<br/><br/>";
}
```

This will output the evaluation process and results for each expression:

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

#### Note

The StrToBcmath class uses the PHP bcmath library for computation, so your PHP environment needs to support the bcmath library.

#### Contribute to the mix

1. Fork the repository
2. Create a new Feat_xxx branch
3. Submit the code
4. Create a new pull request