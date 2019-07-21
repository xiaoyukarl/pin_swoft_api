<?php
/**
 * Created by PhpStorm.
 * User: xiaoyukarl
 * Date: 2019-07-08
 * Time: 22:04
 */

namespace App\Model\Data;

use App\Model\Dao\BannerDao;
use Swoft\Bean\Annotation\Mapping\Bean;
use Swoft\Bean\Annotation\Mapping\Inject;

/**
 * @Bean()
 * Class BannerData
 * @package App\Model\Data
 */
class BannerData extends BaseData
{

    /**
     * @Inject()
     * @var BannerDao
     */
    protected $bannerDao;

    public function getHomeBanner()
    {
        $banners = $this->bannerDao->getHomeBanner();
        $bannerData = [];
        if(!empty($banners)){
            foreach ($banners as $banner){
                $banner = $banner->toArray();
                $banner['imgUrl'] = $this->getImgUrl($banner['img']);
                $bannerData[] = $banner;
            }
        }
        return $bannerData;
    }
}