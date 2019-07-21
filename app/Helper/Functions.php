<?php
/**
 * Custom global functions
 */

if(!function_exists('randNum')){
    /**
     * @param int $len
     * @return string
     */
    function randNum($len = 4)
    {
        $numbers = '1234567890';
        $code = '';
        for($i=0;$i<$len;$i++){
            $code .= $numbers[rand(0, strlen($numbers)-1)];
        }
        return $code;
    }
}