<?php
/**
 * Created by PhpStorm.
 * User: xiaoyukarl
 * Date: 2019-07-06
 * Time: 09:47
 */

namespace App\Aspect;


use Swoft\Aop\Annotation\Mapping\After;
use Swoft\Aop\Annotation\Mapping\AfterReturning;
use Swoft\Aop\Annotation\Mapping\AfterThrowing;
use Swoft\Aop\Annotation\Mapping\Around;
use Swoft\Aop\Annotation\Mapping\Aspect;
use Swoft\Aop\Annotation\Mapping\Before;
use Swoft\Aop\Annotation\Mapping\PointExecution;

/**
 * @Aspect()
 * @PointExecution(include={"App\Http\Controller\TestController::point.*"})
 * Class KarlAspect
 * @package App\Aspect
 */
class KarlAspect
{

    /**
     * @Before()
     */
    public function before()
    {
        echo "before".PHP_EOL;
    }

    /**
     * @After()
     */
    public function after()
    {
        echo "after".PHP_EOL;
    }

//    /**
//     * @Around()
//     */
//    public function around()
//    {
//        echo "around".PHP_EOL;
//    }

    /**
     * @AfterReturning()
     */
    public function afterRunning()
    {
        echo "afterRunning".PHP_EOL;
    }

//    /**
//     * @AfterThrowing()
//     */
//    public function afterThrow()
//    {
//        echo "throw exception".PHP_EOL;
//    }

}