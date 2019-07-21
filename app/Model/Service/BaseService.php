<?php
/**
 * Created by PhpStorm.
 * User: xiaoyukarl
 * Date: 2019-07-09
 * Time: 11:25
 */

namespace App\Model\Service;


class BaseService
{

    /**
     * 支持保存url和base64的图片
     * @param $dir 如“banner”，“user”
     * @param $img
     * @return string
     */
    public function upload($dir, $img)
    {
        if(preg_match('/http/', $img)){
            $pack = file_get_contents($img);
        }else{
            $replace = ['data:image/jpeg;base64,', 'data:image/jpg;base64,', 'data:image/png;base64,'];
            $img = str_replace($replace, ['','',''], $img);
            $pack = base64_decode($img);
        }
        $publicPath = alias('@base/public/upload/' . $dir .'/');
        $month = date('Ym');
        if(!is_dir($publicPath . $month)){
            mkdir($publicPath . $month, 0777, true);
        }
        $fileName = $this->getRandNum('U') .'.jpg';
        file_put_contents($publicPath . $month . '/' . $fileName, $pack);
        return $dir . '/' . $month . '/' . $fileName ;
    }


    /**
     * 获取随机名称
     * @param string $preKey
     * @param int $num
     * @return string
     */
    public function getRandNum($preKey='', $num=4)
    {
        $str = '';
        for ($i = 0; $i < $num; $i++) {
            $str .= mt_rand(0, 9);
        }
        return $preKey . date("ymdHis", time()) . $str;
    }
}