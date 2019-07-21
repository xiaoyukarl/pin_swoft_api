<?php
declare(strict_types=1);

/**
 * Created by PhpStorm.
 * User: xiaoyukarl
 * Date: 2019-06-27
 * Time: 23:39
 */
namespace App\Event;
use Swoft\Event\Annotation\Mapping\Listener;
use Swoft\Event\EventHandlerInterface;
use Swoft\Event\EventInterface;

/**
 * @Listener("testEvent")
 * Class TestEvent
 */
class TestEvent implements EventHandlerInterface
{
    /**
     * @param EventInterface $event
     */
    public function handle(EventInterface $event) :void
    {
        $pos = __METHOD__;
        var_dump($event->getParams());
        echo "handle the event '{$event->getName()}' on the: $pos\n";
    }

}