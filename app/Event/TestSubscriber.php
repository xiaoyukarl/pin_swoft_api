<?php
/**
 * Created by PhpStorm.
 * User: xiaoyukarl
 * Date: 2019-06-27
 * Time: 23:58
 */

namespace App\Event;


use Swoft\Event\Annotation\Mapping\Listener;
use Swoft\Event\Annotation\Mapping\Subscriber;
use Swoft\Event\EventHandlerInterface;
use Swoft\Event\EventInterface;
use Swoft\Event\EventSubscriberInterface;
use Swoft\Event\Listener\ListenerPriority;

/**
 * @Subscriber()
 * Class TestSubscriber
 * @package App\Event
 */
class TestSubscriber implements EventSubscriberInterface
{

    public const EVENT_ONE = 'test.event1';
    public const EVENT_TWO = 'test.event2';

    /**
     * Configure events and corresponding processing methods (you can configure the priority)
     * @return array
     * [
     *  'event name' => 'handler method'
     *  'event name' => ['handler method', priority]
     * ]
     */
    public static function getSubscribedEvents(): array
    {
        return [
            self::EVENT_ONE => 'handleEvent1',
            self::EVENT_TWO => ['handleEvent2', ListenerPriority::HIGH],
        ];
    }

    public function handleEvent1(EventInterface $evt): void
    {
        var_dump($evt->getParams(),'handleEvent1');
        $evt->setParams(['msg' => 'handle the event: test.event1 position: TestSubscriber.handleEvent1()']);
    }

    public function handleEvent2(EventInterface $evt): void
    {
        var_dump($evt->getParams(),'handleEvent2');
        $evt->setParams(['msg' => 'handle the event: test.event2 position: TestSubscriber.handleEvent2()']);
    }

}