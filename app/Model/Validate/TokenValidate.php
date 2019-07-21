<?php
/**
 * Created by PhpStorm.
 * User: xiaoyukarl
 * Date: 2019-07-09
 * Time: 10:35
 */

namespace App\Model\Validate;


use App\Utils\Validate\Validate;
use Swoft\Bean\Annotation\Mapping\Bean;

/**
 * @Bean()
 * Class TokenValidate
 * @package App\Model\Validate
 */
class TokenValidate extends Validate
{

    protected $rule = [
        'token' => 'require'
    ];

    protected $message = [
        'token.require' => '请传token',
    ];

    protected $scene = [
        'check' => ['token']
    ];
}