<?php declare(strict_types=1);

namespace App\Exception\Handler;


use App\Exception\ApiException;
use Swoft\Error\Annotation\Mapping\ExceptionHandler;
use Swoft\Http\Message\Response;
use Swoft\Http\Server\Exception\Handler\AbstractHttpErrorHandler;
use Swoft\Log\Helper\Log;
use Throwable;

/**
 * Class ApiExceptionHandler
 *
 * @since 2.0
 *
 * @ExceptionHandler(ApiException::class)
 */
class ApiExceptionHandler extends AbstractHttpErrorHandler
{

    /**
     * @param Throwable $except
     * @param Response $response
     * @return Response
     * @throws \ReflectionException
     * @throws \Swoft\Bean\Exception\ContainerException
     */
    public function handle(Throwable $except, Response $response): Response
    {
        $data = [
            'code'  => $except->getCode(),
            'msg' => sprintf('(%s) %s', get_class($except), $except->getMessage()),
            'file'  => sprintf('At %s line %d', $except->getFile(), $except->getLine()),
            //'trace' => $except->getTraceAsString(),
        ];
        Log::error("api error %s", $data['msg']);
       return $response->withData($data);
    }
}
