<?php

class Solution
{
    /**
     * @param String[] $tokens
     * @return Integer
     */
    function evalRPN(array $tokens): int
    {
        $operators = ['+', '-', '*', '/'];
        $stack = [];

        if (!isset($tokens[1])) {
            return $tokens[0];
        }

        foreach ($tokens as $token) {
            if (in_array($token, $operators)) {
                $second = array_pop($stack);
                $first = array_pop($stack);

                $result = match ($token) {
                    '+' => $first + $second,
                    '-' => $first - $second,
                    '*' => $first * $second,
                    '/' => $first / $second,
                };

                $stack[] = (int) $result;
            } else {
                $stack[] = $token;
            }
        }

        return $stack[0];
    }
}