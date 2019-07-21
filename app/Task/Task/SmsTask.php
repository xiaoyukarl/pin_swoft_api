<?php
/**
 * Created by PhpStorm.
 * User: xiaoyukarl
 * Date: 2019-07-01
 * Time: 22:38
 */

namespace App\Task\Task;

use App\Utils\Sms;
use Swoft\Task\Annotation\Mapping\Task;
use Swoft\Task\Annotation\Mapping\TaskMapping;

/**
 * @Task(name="sms")
 * Class SmsTask
 * @package App\Task\Task
 */
class SmsTask
{
    protected $templateCode = 'SMS_141045001';

    /**
     * @TaskMapping(name="sendCode")
     * @param $mobile
     * @param $code
     * @return bool|\stdClass
     */
    public function send($mobile, $code)
    {
        //Sms::sendSms($mobile, $this->templateCode, ['code' => $code]);
        return [$mobile, $code];
    }
}