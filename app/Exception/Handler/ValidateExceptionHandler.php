<?php
/**
 * Created by PhpStorm.
 * User: xiaoyukarl
 * Date: 2019-06-30
 * Time: 11:38
 */

namespace App\Exception\Handler;


use App\Exception\ValidateException;
use Swoft\Error\Annotation\Mapping\ExceptionHandler;
use Swoft\Http\Message\Response;
use Swoft\Http\Server\Exception\Handler\AbstractHttpErrorHandler;
use Throwable;

/**
 * @ExceptionHandler(ValidateException::class)
 * Class ValidateExceptionHandler
 * @package App\Exception\Handler
 */
class ValidateExceptionHandler extends AbstractHttpErrorHandler
{

    public function handle(Throwable $e, Response $response): Response
    {
        $data = [
            'code'  => 3001,
            'msg' => $e->getMessage(),
            'data' => []
        ];
        return $response->withData($data);

    }

}