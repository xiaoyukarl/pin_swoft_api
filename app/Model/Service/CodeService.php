<?php
/**
 * Created by PhpStorm.
 * User: xiaoyukarl
 * Date: 2019-06-30
 * Time: 11:42
 */

namespace App\Model\Service;


use App\Exception\ApiException;
use App\Exception\ValidateException;
use App\Utils\Validate\Validate;
use Swoft\Bean\Annotation\Mapping\Bean;
use Swoft\Bean\Annotation\Mapping\Inject;
use Swoft\Redis\Pool;

/**
 * @Bean()
 * Class CodeService
 * @package App\Model\Service
 */
class CodeService
{

    /**
     * @Inject()
     * @var Pool
     */
    protected $redis;

    /**
     * @param $mobile
     * @return int
     * @throws ApiException
     * @throws ValidateException
     */
    public function getCode($mobile)
    {
        //生成验证码与手机关联，并保存到redis
        $this->checkMobile($mobile);
        $ttl = 120;
        $code = randNum();
        $key = "code:{$mobile}";

        $exp = $this->redis->ttl($key);
        if($exp > 0){
            throw new ApiException("请在{$exp}秒之后再获取验证码");
        }
        $this->redis->set($key, $code, $ttl);
        //异步发送验证码
        return $code;
    }

    /**
     * @param $mobile
     * @param $code
     * @throws ApiException
     */
    public function checkCode($mobile, $code)
    {
        $key = "code:{$mobile}";
        $cacheCode = $this->redis->get($key);
        if($cacheCode != $code){
            throw new ApiException('验证码错误');
        }
    }

    /**
     * 校验手机号码
     * @param $mobile
     * @throws ValidateException
     */
    public function checkMobile($mobile)
    {
        $rule = [
            'mobile' => 'require|mobile'
        ];

        $message = [
            'mobile.require' => '手机号不能为空',
            'mobile.mobile' => '手机号格式不正确'
        ];

        $validate = Validate::make($rule, $message);
        if(!$validate->check(['mobile' => $mobile])){
            throw new ValidateException($validate->getError());
        }
    }

}