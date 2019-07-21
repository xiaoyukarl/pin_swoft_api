<?php
/**
 * Created by PhpStorm.
 * User: xiaoyukarl
 * Date: 2019-07-06
 * Time: 15:45
 */

namespace App\WebSocket\Chat;

use App\Exception\WsException;
use Swoft\Session\Session;
use Swoft\WebSocket\Server\Annotation\Mapping\MessageMapping;
use Swoft\WebSocket\Server\Annotation\Mapping\WsController;

/**
 * @WsController(prefix="test")
 * Class TestController
 * @package App\WebSocket\Chat
 */
class TestController
{

    /**
     * @MessageMapping(command="index")
     * @param $data
     */
    public function index($data)
    {
//        throw  new WsException("test exception");
        Session::mustGet()->push("TestController return ". $data);
    }
}