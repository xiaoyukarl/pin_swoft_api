<?php
/**
 * Created by PhpStorm.
 * User: xiaoyukarl
 * Date: 2019-07-07
 * Time: 09:52
 */

namespace App\Exception\Handler;


use App\Exception\WsException;
use Swoft\Error\Annotation\Mapping\ExceptionHandler;
use Swoft\Log\Helper\Log;
use Swoft\WebSocket\Server\Exception\Handler\AbstractMessageErrorHandler;
use Swoole\WebSocket\Frame;
use Throwable;

/**
 * @ExceptionHandler(WsException::class)
 * Class WsMessageExceptionHandler
 * @package App\Exception\Handler
 */
class WsMessageExceptionHandler extends AbstractMessageErrorHandler
{
    public function handle(Throwable $e, Frame $frame): void
    {
        Log::error("ws error message %s on line %s",$e->getMessage(),$e->getLine() );
        $data = [
            "cmd" => "message",
            'message' => $e->getMessage()
        ];
        server()->push($frame->fd,json_encode($data, JSON_UNESCAPED_UNICODE));
    }

}