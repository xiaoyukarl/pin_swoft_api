<?php
/**
 * Created by PhpStorm.
 * User: xiaoyukarl
 * Date: 2019-07-15
 * Time: 23:26
 */

namespace App\Model\Validate;


use App\Utils\Validate\Validate;
use Swoft\Bean\Annotation\Mapping\Bean;

/**
 * @Bean()
 * Class CollectValidate
 * @package App\Model\Validate
 */
class CollectValidate extends Validate
{
    protected $rule = [
        'orderId' => 'require|number'
    ];

    protected $message = [
        'orderId.require' => '请传递orderId参数',
        'orderId.number' => 'orderId 必须为数字'
    ];

    public function scene($name)
    {
        return [
            'create' => ['orderId']
        ];
    }
}