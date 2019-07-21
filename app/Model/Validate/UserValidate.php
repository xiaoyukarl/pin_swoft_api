<?php
/**
 * Created by PhpStorm.
 * User: xiaoyukarl
 * Date: 2019-06-29
 * Time: 15:15
 */

namespace App\Model\Validate;

use App\Utils\Validate\Validate;
use Swoft\Bean\Annotation\Mapping\Bean;

/**
 * @Bean()
 * Class UserValidate
 * @package App\Model\Validate
 */
class UserValidate extends Validate
{
    protected $rule = [
        'username'=>'require',
        'telephone'=>'mobile',
        'code'=>'require',
    ];

    protected $message = [
        'username.require'=>'请输入用户名',
        'telephone.mobile'=>'请输入正确手机号码',
        'code.require'=>'请传wx code',
    ];

    protected $scene = [
        'update'=>['telephone','username'],
        'wxlogin' => ['code']
    ];

}