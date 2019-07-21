<?php
/**
 * Created by PhpStorm.
 * User: xiaoyukarl
 * Date: 2019-06-30
 * Time: 10:54
 */

namespace App\Model\Service;


use App\Exception\ApiException;
use App\Exception\TokenException;
use App\Exception\ValidateException;
use App\Model\Dao\UserDao;
use App\Model\Data\UserData;
use App\Model\Data\UsersData;
use App\Model\Entity\User;
use App\Model\Entity\Users;
use Firebase\JWT\JWT;
use GuzzleHttp\Client;
use Swoft\Bean\Annotation\Mapping\Bean;
use Swoft\Bean\Annotation\Mapping\Inject;

/**
 * @Bean()
 * Class UserService
 * @package App\Model\Service
 */
class UserService extends BaseService
{

    /**
     * @Inject()
     * @var UserDao
     */
    protected $userDao;

    /**
     * @Inject()
     * @var UsersData
     */
    protected $userData;


    /**
     * 根据openId获取用户
     * @param $openId
     * @return object|\Swoft\Db\Eloquent\Builder|\Swoft\Db\Eloquent\Model|null
     * @throws \ReflectionException
     * @throws \Swoft\Bean\Exception\ContainerException
     * @throws \Swoft\Db\Exception\DbException
     */
    public function getUserByOpenId($openId)
    {
        return $this->userDao->getUserByOpenId($openId);
    }

    /**
     * @param $userId
     * @return mixed
     */
    public function getUserInfo($userId)
    {
        return $this->userData->getUserInfo($userId);
    }

    /**
     * @param $openId
     * @return string
     * @throws ValidateException
     * @throws \ReflectionException
     * @throws \Swoft\Bean\Exception\ContainerException
     * @throws \Swoft\Db\Exception\DbException
     */
    public function login($openId)
    {
        $user = $this->getUserByOpenId($openId);
        if(!$user){
            throw new ValidateException("用户不存在");
        }
        $this->getUserInfo($user->getId());//缓存用户
        $token = $this->getUserToken($user->getId());
        return $token;
    }

    public function update($data, $userId)
    {
        $oldUser = $this->userDao->getUserById($userId);
        $path = alias('@base/public/upload/');
        if(!empty($data['avatar'])){
            $data['avatar'] = $this->upload('user', $data['avatar']);
            if(!empty($oldUser->getAvatar()) && is_file($path . $oldUser->getAvatar())){
                @unlink($path . $oldUser->getAvatar());
            }
        }
        $update = [];
        foreach ($data as $key=>$value) {
            if(!empty($value)){
                $update[$key] = $value;
            }
        }
        $this->userData->updateUserInfo($update, $userId);
        $user =  $this->userData->resetUserInfo($userId);//重新缓存用户信息
        return [
            'username' => $user->getUsername(),
            'telephone' => $user->getTelephone(),
            'avatarUrl' => $this->userData->getImgUrl($user->getAvatar())
        ];
    }


    /**
     * @param $userId
     * @return string
     * @throws \ReflectionException
     * @throws \Swoft\Bean\Exception\ContainerException
     */
    public function getUserToken(int $userId)
    {
        $config = \Swoft::getBean('config');
        $jwt = $config->get('jwt');
        $privateKey = $jwt['privateKey'];
        $exp = $jwt['exp'];
        $type = $jwt['type'];

        $tokenParams = [
            'userId' => $userId,
            'iat' => time(),
            'time' => time() . $exp
        ];

        $token = JWT::encode($tokenParams, $privateKey, $type);
        return $token;
    }

    /**
     * 验证token
     * @param $token
     * @return bool
     * @throws TokenException
     * @throws \ReflectionException
     * @throws \Swoft\Bean\Exception\ContainerException
     */
    public function checkUserToken($token)
    {
        $config = \Swoft::getBean('config');
        $jwt = $config->get('jwt');
        $publicKey = $jwt['publicKey'];
        $type = $jwt['type'];
        try{
            $auth = JWT::decode($token, $publicKey, [ 'type' => $type]);
        }catch (\Exception $exception){
            //抛出异常
            throw new TokenException('授权验证失败11');
        }
        return true;
    }

    public function getUserInfoByCode($code)
    {
        $config = \Swoft::getBean('config');
        $url = sprintf($config['wx.wxLoginUrl'], $config['wx.wxAppId'], $config['wx.wxAppSecret'], $code);

        $client = new Client();
        $response = $client->get($url);
        $jsonMsg = $response->getBody()->getContents();
        $json = json_decode($jsonMsg, true);
        if(!$json || array_key_exists('errcode',$json)){
            //抛出错误
            throw new TokenException('微信登录失败');
        }
        $data = ['openId' => $json['openid']];
        $user = $this->userDao->updateOrCreate($data, $data);
        //生成token
        $token = $this->getUserToken($user->id);

        return $token;

    }
}