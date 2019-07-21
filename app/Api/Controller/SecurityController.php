<?php
/**
 * Created by PhpStorm.
 * User: xiaoyukarl
 * Date: 2019-07-08
 * Time: 23:57
 */

namespace App\Api\Controller;


use App\Model\Logic\TokenLogic;
use App\Model\Logic\UsersLogic;
use App\Model\Service\UserService;
use App\Model\Validate\TokenValidate;
use App\Utils\Message;
use Swoft\Bean\Annotation\Mapping\Inject;
use Swoft\Http\Message\Request;
use Swoft\Http\Server\Annotation\Mapping\Controller;
use Swoft\Http\Server\Annotation\Mapping\RequestMapping;
use Swoft\Http\Server\Annotation\Mapping\RequestMethod;

/**
 * @Controller(prefix="/api/security")
 * Class AccountController
 * @package App\Api\Controller
 */
class SecurityController
{
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
     * @Inject()
     * @var TokenLogic
     */
    protected $tokenLogic;


    /**
     * @RequestMapping(route="wxlogin")
     * @param Request $request
     * @return array
     * @throws \App\Exception\TokenException
     * @throws \App\Exception\ValidateException
     */
    public function wxLogin(Request $request)
    {
        $data = $request->post();
        $this->userLogic->wxlogin($data);//验证数据
        $token = $this->userService->getUserInfoByCode($data['code']);
        return Message::success(['token' => $token]);
    }

//    /**
//     * 逻辑应该是根据code来获取token
//     * @RequestMapping(route="token",method={RequestMethod::POST})
//     * @param Request $request
//     * @return array
//     * @throws \App\Exception\ValidateException
//     * @throws \ReflectionException
//     * @throws \Swoft\Bean\Exception\ContainerException
//     * @throws \Swoft\Db\Exception\DbException
//     */
//    public function token(Request $request)
//    {
//        $openId = $request->post('openId');
//        $token = $this->userService->login($openId);
//        return Message::success(['token' => $token]);
//    }

    /**
     * @RequestMapping(route="verify",method={RequestMethod::POST})
     * @param Request $request
     * @return array
     * @throws \App\Exception\TokenException
     * @throws \App\Exception\ValidateException
     * @throws \ReflectionException
     * @throws \Swoft\Bean\Exception\ContainerException
     */
    public function verify(Request $request)
    {
        $token = $request->post('token', false);
        $this->tokenLogic->check($token);
        $this->userService->checkUserToken($token);
        return Message::success();
    }
}