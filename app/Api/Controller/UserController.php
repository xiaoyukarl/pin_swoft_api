<?php
/**
 * Created by PhpStorm.
 * User: xiaoyukarl
 * Date: 2019-07-08
 * Time: 16:21
 */
namespace App\Api\Controller;

use App\Api\Middleware\ApiMiddleware;
use App\Exception\ApiException;
use App\Model\Data\OrdersData;
use App\Model\Data\UsersData;
use App\Model\Logic\OrderLogic;
use App\Model\Logic\UsersLogic;
use App\Model\Service\OrderService;
use App\Model\Service\UserService;
use App\Utils\Message;
use Swoft\Bean\Annotation\Mapping\Inject;
use Swoft\Http\Message\Request;
use Swoft\Http\Server\Annotation\Mapping\Controller;
use Swoft\Http\Server\Annotation\Mapping\Middleware;
use Swoft\Http\Server\Annotation\Mapping\RequestMapping;
use Swoft\Http\Server\Annotation\Mapping\RequestMethod;

/**
 * @Controller(prefix="/api/user")
 * @Middleware(ApiMiddleware::class)
 * Class UserController
 * @package App\Api\Controller
 */
class UserController
{

    /**
     * @Inject()
     * @var UsersData
     */
    protected $userData;

    /**
     * @Inject()
     * @var UsersLogic
     */
    protected $userLogic;

    /**
     * @Inject()
     * @var UserService
     */
    protected $userService;


    /**
     * 用户信息
     * @RequestMapping(route="info")
     * @param Request $request
     * @return bool|mixed
     */
    public function info(Request $request)
    {
        $info = $this->userData->getUserInfo($request->userId);
        return Message::success($info);
    }


    /**
     * 更新用户信息
     * @RequestMapping(route="update", method={RequestMethod::POST})
     * @param Request $request
     * @return array
     * @throws \App\Exception\ValidateException
     */
    public function updateUserInfo(Request $request)
    {
        $data = $request->post();
        $this->userLogic->update($data);
        $data = $this->userService->update($data, $request->userId);
        return Message::success($data);
    }

}