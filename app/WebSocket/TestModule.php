<?php
/**
 * Created by PhpStorm.
 * User: xiaoyukarl
 * Date: 2019-07-06
 * Time: 15:45
 */

namespace App\WebSocket;

use App\WebSocket\Chat\TestController;
use Swoft\WebSocket\Server\Annotation\Mapping\WsModule;
use Swoft\WebSocket\Server\MessageParser\JsonParser;

/**
 * @WsModule(
 *     path="/test",
 *     controllers={
 *          TestController::class
 *     },
 *     messageParser=JsonParser::class
 *     )
 * Class TestModule
 * @package App\WebSocket
 */
class TestModule
{

}