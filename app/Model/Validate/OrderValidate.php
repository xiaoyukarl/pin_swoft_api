<?php
/**
 * Created by PhpStorm.
 * User: xiaoyukarl
 * Date: 2019-07-09
 * Time: 10:44
 */

namespace App\Model\Validate;


use App\Utils\Validate\Validate;
use Swoft\Bean\Annotation\Mapping\Bean;

/**
 * @Bean()
 * Class OrderValidate
 * @package App\Model\Validate
 */
class OrderValidate extends Validate
{

    protected $rule = [
        'type' => 'require|number',
        'title' => 'require',
        'destCity' => 'require',
        'starCity' => 'require',
        'departureTime' => 'require',
        'telephone' => 'require|mobile',
        'content' => 'require',
    ];

    protected $message = [
        'type.require' => '类型必须填写',
        'type.number' => '类型必须是整数',
        'title.require' => '标题必须填写',
        'destCity.require' => '到达城市必须填写',
        'starCity.require' => '出发城市必须填写',
        'departureTime.require' => '出发时间必须填写',
        'telephone.require' => '手机号必须填写',
        'telephone.mobile' => '手机号格式不正确',
        'content.require' => '请填写备注信息',
    ];

    protected $scene = [
        'create' => ['type','title','destCity','starCity','departureTime','telephone','content'],
        'update' => ['title','destCity','starCity','departureTime','telephone','content'],
    ];
}