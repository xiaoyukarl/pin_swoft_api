<?php
/**
 * Created by PhpStorm.
 * User: xiaoyukarl
 * Date: 2019-07-08
 * Time: 17:07
 */

namespace App\Api\Controller;


use App\Utils\Message;
use Swoft\Bean\Annotation\Mapping\Inject;
use Swoft\Http\Server\Annotation\Mapping\Controller;
use Swoft\Http\Server\Annotation\Mapping\RequestMapping;
use Swoft\Redis\Pool;

/**
 * @Controller(prefix="/api/config")
 * Class ConfigController
 * @package App\Api\Controller
 */
class ConfigController
{
    /**
     * @Inject()
     * @var Pool
     */
    protected $redis;

    /**
     * @RequestMapping(route="city")
     * @return array
     */
    public function city()
    {
        $cities = $this->redis->get('cityInfo');
        if(!$cities){
            $cities = [];
        }else{
            $cities = json_decode($cities, JSON_UNESCAPED_UNICODE);
        }
        return Message::success($cities);
    }



    public function dutyWork()
    {
        //过滤脏话,
    }


}