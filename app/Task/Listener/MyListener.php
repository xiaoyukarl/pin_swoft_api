<?php
/**
 * Created by PhpStorm.
 * User: xiaoyukarl
 * Date: 2019-07-01
 * Time: 22:20
 */

namespace App\Task\Listener;


use Swoft\Event\Annotation\Mapping\Listener;
use Swoft\Event\EventHandlerInterface;
use Swoft\Event\EventInterface;
use Swoft\Task\TaskEvent;

/**
 * @Listener(event="sms")
 * Class MyListener
 * @package App\Task\Listener
 */
class MyListener implements EventHandlerInterface
{

    public function handle(EventInterface $event): void
    {
        var_dump($event->getParams(),'111111111');
    }
}