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
use Swoft\Bean\Annotation\Mapping\Inject;

/**
 * @Bean()
 * Class IdValidate
 * @package App\Model\Validate
 */
class IdValidate extends Validate
{

    protected $rule = [
        'id' => 'require|number'
    ];

    protected $message = [
        'id.require' => '请传递id参数',
        'id.number' => 'id 必须为数字'
    ];

}