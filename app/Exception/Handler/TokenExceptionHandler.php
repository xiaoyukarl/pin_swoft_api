<?php
/**
 * Created by PhpStorm.
 * User: xiaoyukarl
 * Date: 2019-07-09
 * Time: 18:14
 */

namespace App\Exception\Handler;


use App\Exception\TokenException;
use Swoft\Error\Annotation\Mapping\ExceptionHandler;
use Swoft\Http\Message\Response;
use Swoft\Http\Server\Exception\Handler\AbstractHttpErrorHandler;
use Throwable;

/**
 * @ExceptionHandler(TokenException::class)
 * Class TokenExceptionHandler
 * @package App\Exception\Handler
 */
class TokenExceptionHandler extends AbstractHttpErrorHandler
{

    public function handle(Throwable $except, Response $response): Response
    {
        $data = [
            'code'  => 4001,
            'msg' => sprintf('(%s) %s', get_class($except), $except->getMessage()),
            //'file'  => sprintf('At %s line %d', $except->getFile(), $except->getLine()),
        ];

        return $response->withData($data)->withStatus(401);
    }

}