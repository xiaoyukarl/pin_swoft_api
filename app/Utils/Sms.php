<?php
/**
 * +----------------------------------------------------------------------
 * | 阿里云发短信类
 * +----------------------------------------------------------------------
 * | Copyright (c) 2016 http://www.sunnyos.com All rights reserved.
 * +----------------------------------------------------------------------
 * | Date：2018-02-03 17:32:03
 * | Author: Sunny (admin@sunnyos.com) QQ：327388905
 * +----------------------------------------------------------------------
 */
namespace App\Utils;

class Sms{
    const ACCESS_KEY_ID = '';// access_key_id
    const ACCESS_KEY_SECRET = '';// access_key_secret
    const SIGN_NAME = '';// 短信签名

    /**
     * 发送短信方法
     * @param  string $mobile        发送手机号码
     * @param  string $TemplateCode  短信模版id
     * @param  array  $TemplateParam 短信内容数组，根据短信模版里面的变量名设置，一一对应
     * 调用方法： Sms::sendSms(手机号码,'SMS_121165292',['code'=>123])
     * @return bool|stdClass
     */
    public static function sendSms($mobile,$TemplateCode = '',$TemplateParam = []){
        $params = array ();
        $accessKeyId = self::ACCESS_KEY_ID;
        $accessKeySecret = self::ACCESS_KEY_SECRET;
        $params["PhoneNumbers"] = $mobile;
        $params["SignName"] = self::SIGN_NAME;
        $params["TemplateCode"] = $TemplateCode;
        if ($TemplateParam) {
            $params['TemplateParam'] = $TemplateParam;
        }
        // *** 需用户填写部分结束, 以下代码若无必要无需更改 ***
        if(!empty($params["TemplateParam"]) && is_array($params["TemplateParam"])) {
            $params["TemplateParam"] = json_encode($params["TemplateParam"], JSON_UNESCAPED_UNICODE);
        }
        // 此处可能会抛出异常，注意catch
        $content = self::request(
            $accessKeyId,
            $accessKeySecret,
            "dysmsapi.aliyuncs.com",
            array_merge($params, array(
                "RegionId" => "cn-hangzhou",
                "Action" => "SendSms",
                "Version" => "2017-05-25",
            ))
        );
        return $content;
    }

    /**
     * 生成签名并发起请求
     *
     * @param $accessKeyId string AccessKeyId (https://ak-console.aliyun.com/)
     * @param $accessKeySecret string AccessKeySecret
     * @param $domain string API接口所在域名
     * @param $params array API具体参数
     * @param $security boolean 使用https
     * @return bool|\stdClass 返回API接口调用结果，当发生错误时返回false
     */
    public static function request($accessKeyId, $accessKeySecret, $domain, $params, $security=false) {
        $apiParams = array_merge(array (
            "SignatureMethod" => "HMAC-SHA1",
            "SignatureNonce" => uniqid(mt_rand(0,0xffff), true),
            "SignatureVersion" => "1.0",
            "AccessKeyId" => $accessKeyId,
            "Timestamp" => gmdate("Y-m-d\TH:i:s\Z"),
            "Format" => "JSON",
        ), $params);
        ksort($apiParams);

        $sortedQueryStringTmp = "";
        foreach ($apiParams as $key => $value) {
            $sortedQueryStringTmp .= "&" . self::encode($key) . "=" . self::encode($value);
        }
        $stringToSign = "GET&%2F&" . self::encode(substr($sortedQueryStringTmp, 1));

        $sign = base64_encode(hash_hmac("sha1", $stringToSign, $accessKeySecret . "&",true));

        $signature = self::encode($sign);

        $url = ($security ? 'https' : 'http')."://{$domain}/?Signature={$signature}{$sortedQueryStringTmp}";

        try {
            $content = self::fetchContent($url);
            return json_decode($content);
        } catch( \Exception $e) {
            return false;
        }
    }

    private static function encode($str){
        $res = urlencode($str);
        $res = preg_replace("/\+/", "%20", $res);
        $res = preg_replace("/\*/", "%2A", $res);
        $res = preg_replace("/%7E/", "~", $res);
        return $res;
    }

    private static function fetchContent($url) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "x-sdk-client" => "php/2.0.0"
        ));

        if(substr($url, 0,5) == 'https') {
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        }

        $rtn = curl_exec($ch);

        if($rtn === false) {
            trigger_error("[CURL_" . curl_errno($ch) . "]: " . curl_error($ch), E_USER_ERROR);
        }
        curl_close($ch);

        return $rtn;
    }
}
