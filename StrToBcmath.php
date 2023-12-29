<?php

namespace km\tools;

// 字符串转BcMath计算结果
class StrToBcmath {
    /**
     * @var int
     */
    private $scale; // 精度

    /**
     * @var mixed   // 是否显示计算过程
     */
    private $isecho;

    /**
     * @param $scale    // 精度
     * @param $isecho   // 是否显示计算过程
     */
    public function __construct($scale = 8, $isecho = false) {
        $this->scale  = $scale;
        $this->isecho = $isecho;
    }

    // 主方法
    /**
     * @param $expression   // 复杂运算表达式
     * @param $scale    // 精度
     * @param $isRecursive  // 是否递归，递归时不输出计算过程
     */
    public function main($expression, $scale = '', $isRecursive = false) {
        $scale = $scale ?: $this->scale;

        // 原始表达式
        if (!$isRecursive && $this->isecho) {
            echo $expression . '<br/>';
        }

        // 如果输入的表达式为空或者包含非法字符，则抛出异常
        if (empty($expression) || preg_match('/[^0-9\.\+\-\*\/\(\)]/', $expression)) {
            throw new \InvalidArgumentException('表达式错误，仅支持+,-,*,/,**,(),数字：' . $expression);
        }

        // 使用正则表达式匹配表达式中的括号
        while (preg_match('/\(([^\(\)]+)\)/', $expression, $matches)) {
            // 计算括号中的表达式
            $main = $this->main($matches[1], $scale, true);
            // 将没有括号的表达式替换到原表达式中
            $expression = str_replace('(' . $matches[1] . ')', $main, $expression);
            if ($this->isecho) {
                echo '=' . $expression . '<br/>';
            }
        }

        // 处理指数运算
        while (preg_match('/(\d+(\.\d+)?)(\*\*)(\d+(\.\d+)?)/', $expression, $matches)) {
            $main       = $this->basic($matches[0], $scale);
            $expression = str_replace($matches[0], $main, $expression);
            if (!$isRecursive && $this->isecho) {
                echo '=' . $expression . '<br/>';
            }
        }

        // 处理乘法、除法
        while (preg_match('/(\d+(\.\d+)?)([\/*])(\d+(\.\d+)?)/', $expression, $matches)) {
            $main       = $this->basic($matches[0], $scale);
            $expression = str_replace($matches[0], $main, $expression);
            if (!$isRecursive && $this->isecho) {
                echo '=' . $expression . '<br/>';
            }
        }
        // 处理加法和减法
        while (preg_match('/(-?\d+(\.\d+)?)([+\-])(-?\d+(\.\d+)?)/', $expression, $matches)) {
            $main       = $this->basic($matches[0], $scale);
            $expression = str_replace($matches[0], $main, $expression);
            if (!$isRecursive && $this->isecho) {
                echo '=' . $expression . '<br/>';
            }
        }
        // 返回计算结果
        return $expression;
    }

    // 基本的四则运算
    /**
     * @param $expression   // 基本的四则运算表达式
     * @param $scale    // 精度
     */
    public function basic($expression, $scale = '') {
        $scale = $scale ?: $this->scale;
        // 使用正则表达式匹配表达式中的两个操作数和一个运算符
        if (!preg_match('/^(-?\d+(\.\d+)?)([\/*+-]|(\*\*))(-?\d+(\.\d+)?)$/', $expression, $matches)) {
            throw new \InvalidArgumentException('表达式错误，不符合基本的四则运算：' . $expression);
        }
        // dump($matches);
        // 根据运算符调用对应的 bcmath 函数
        $operator = $matches[3];
        $a        = strval($matches[1]);
        $b        = $matches[5];
        // if ($this->isecho) {
        //     echo '【处理运算符】' . $a . $operator . $b . '<br/>';
        // }
        try {
            switch ($operator) {
            case '+':
                return bcadd($a, $b, $scale);
            case '-':
                return bcsub($a, $b, $scale);
            case '*':
                return bcmul($a, $b, $scale);
            case '/':
                if ($b == 0) {
                    throw new \InvalidArgumentException('除数不能为零');
                }
                return bcdiv($a, $b, $scale);
            case '**':
                return bcpow($a, $b, $scale);
            default:
                throw new \InvalidArgumentException('未知的运算符：' . $operator);
            }
        } catch (\Exception $e) {
            throw new \InvalidArgumentException($e->getMessage());
        }
    }

}