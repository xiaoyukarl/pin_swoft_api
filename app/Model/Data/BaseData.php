<?php
/**
 * Created by PhpStorm.
 * User: xiaoyukarl
 * Date: 2019-07-09
 * Time: 15:29
 */

namespace App\Model\Data;

use Swoft\Bean\Annotation\Mapping\Bean;

/**
 * @Bean()
 * Class BaseData
 * @package App\Model\Data
 */
class BaseData extends RepositoryData
{

    /**
     * 转换图片为url格式
     * @param $img
     * @return string
     * @throws \ReflectionException
     * @throws \Swoft\Bean\Exception\ContainerException
     */
    public function getImgUrl($img)
    {
        $baseUrl = config('common.baseUrl');
        $path = alias('@base/public/upload/');
        $imgUrl = '';
        if(!empty($img) && is_file($path . $img)){
            $imgUrl = $baseUrl .'upload/'. $img;
        }
        return $imgUrl;
    }

}