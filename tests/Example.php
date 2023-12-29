<?php

namespace k6xiao\Tests;

use k6xiao\StrToBcmath;

class Example {
    public function test1() {
        $math   = new StrToBcmath();
        $result = $math->of('(((2.5-3.5)+8)**(5-1)+6)/2');
        // a**b 表示a的b次方
        echo $result; // 1203.50000000
    }

    public function test2() {
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
    }
}