<?php
/**
 * Created by PhpStorm.
 * User: xiaoyukarl
 * Date: 2019-06-29
 * Time: 11:26
 */

namespace App\Api\Middleware;


use App\Exception\ApiException;
use App\Exception\TokenException;
use Co\Context;
use Firebase\JWT\JWT;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Swoft\Bean\Annotation\Mapping\Bean;

/**
 *
 * @Bean()
 * Class ApiMiddleware
 * @package App\Http\Middleware
 */
class ApiMiddleware implements MiddlewareInterface
{

    /**
     * @param ServerRequestInterface $request
     * @param RequestHandlerInterface $handler
     * @return ResponseInterface
     * @throws TokenException
     * @throws \ReflectionException
     * @throws \Swoft\Bean\Exception\ContainerException
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        //before,前置操作

        $token = $request->getHeader('token');
        $config = \Swoft::getBean('config');
        $jwt = $config->get('jwt');
        $publicKey = $jwt['publicKey'];
        $type = $jwt['type'];

        try{
            $auth = JWT::decode($token[0], $publicKey, [ 'type' => $type]);
            $request->userId = $auth->userId;
        }catch (\Exception $exception){
            //抛出异常
            throw new TokenException('授权验证失败');
        }

        $response = $handler->handle($request);//controller

        //after,后置操作
        return $response;
    }

}