<?php
/**
 * Created by PhpStorm.
 * User: xiaoyukarl
 * Date: 2019-07-08
 * Time: 22:02
 */

namespace App\Model\Dao;

use App\Model\Entity\Banners;
use Swoft\Bean\Annotation\Mapping\Bean;

/**
 * @Bean()
 * Class BannerDao
 * @package App\Model\Dao
 */
class BannerDao
{

    public function getHomeBanner()
    {
        return Banners::where('bannerTypeId', 1)
            ->orderBy('sort','desc')
            ->orderBy('id','desc')
            ->get();
    }
}