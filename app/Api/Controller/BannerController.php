<?php
/**
 * Created by PhpStorm.
 * User: xiaoyukarl
 * Date: 2019-07-08
 * Time: 22:00
 */

namespace App\Api\Controller;


use App\Model\Data\BannerData;
use App\Utils\Message;
use Swoft\Bean\Annotation\Mapping\Inject;
use Swoft\Http\Server\Annotation\Mapping\Controller;
use Swoft\Http\Server\Annotation\Mapping\RequestMapping;
use Swoft\Http\Server\Annotation\Mapping\RequestMethod;

/**
 * @Controller(prefix="/api/banner")
 * Class BannerController
 * @package App\Api\Controller
 */
class BannerController
{

    /**
     * @Inject()
     * @var BannerData
     */
    protected $bannerData;

    /**
     * 获取首页banner
     * @RequestMapping(route="home", method={RequestMethod::GET})
     * @return array
     */
    public function home()
    {
        return Message::success($this->bannerData->getHomeBanner());
    }
}