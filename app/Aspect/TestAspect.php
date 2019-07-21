<?php
/**
 * Created by PhpStorm.
 * User: xiaoyukarl
 * Date: 2019-07-06
 * Time: 10:23
 */

namespace App\Aspect;

use Swoft\Aop\Annotation\Mapping\After;
use Swoft\Aop\Annotation\Mapping\Aspect;
use Swoft\Aop\Annotation\Mapping\Before;
use Swoft\Aop\Annotation\Mapping\PointBean;

/**
 * @Aspect()
 * @PointBean(include={App\Bean\TestBean::class})
 * Class TestAspect
 * @package App\Aspect
 */
class TestAspect
{

    /**
     * @Before()
     */
    public function before()
    {
        echo "point bean before" . PHP_EOL;
    }

    /**
     * @After()
     */
    public function after()
    {
        echo "point bean after" .PHP_EOL;
    }

}