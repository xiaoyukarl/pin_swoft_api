<?php
/**
 * Created by PhpStorm.
 * User: xiaoyukarl
 * Date: 2019-06-30
 * Time: 17:02
 */

namespace App\Task\Task;


use Swoft\Task\Annotation\Mapping\Task;
use Swoft\Task\Annotation\Mapping\TaskMapping;

/**
 * @Task(name="mytask")
 * Class MyTask
 * @package App\Task\Task
 */
class MyTask
{

    /**
     * @TaskMapping(name="tt")
     * @param $param1
     * @param $param2
     * @return array
     */
    public function tt($param1, $param2)
    {
        return [$param1, $param2];
    }

}