<?php
/**
 * +----------------------------------------------------------------------
 * |
 * +----------------------------------------------------------------------
 * | Copyright (c) 2016 http://www.sunnyos.com All rights reserved.
 * +----------------------------------------------------------------------
 * | Date：2019-02-27 23:16:02
 * | Author: Sunny (admin@sunnyos.com) QQ：327388905
 * +----------------------------------------------------------------------
 */

namespace App\Utils;


class Message
{
    const CODE_SUCCESS = 0;
    const CODE_ERROR = 4000;

    /**
     * 接口返回正确信息格式
     * @param array $data
     * @param int $code
     * @param string $msg
     * @return array
     */
    public static function success($data = [], $code = self::CODE_SUCCESS, $msg = 'success')
    {
        return ['code' => $code, 'msg' => $msg, 'data' => $data];
    }

    /**
     * 接口返回错误信息格式
     * @param int $code
     * @param string $msg
     * @param array $data
     * @return array
     */
    public static function error($code = self::CODE_ERROR, $msg = 'error', $data = [])
    {
        return ['code' => $code, 'msg' => $msg, 'data' => $data];
    }
}
