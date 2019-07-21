<?php
/**
 * Created by PhpStorm.
 * User: xiaoyukarl
 * Date: 2019-07-10
 * Time: 10:39
 */

namespace App\Model\Logic;

use App\Exception\ValidateException;
use App\Model\Validate\TokenValidate;
use Swoft\Bean\Annotation\Mapping\Bean;
use Swoft\Bean\Annotation\Mapping\Inject;

/**
 * @Bean()
 * Class TokenLogic
 * @package App\Model\Logic
 */
class TokenLogic
{

    /**
     * @Inject()
     * @var TokenValidate
     */
    protected $tokenValidate;

    public function check($token)
    {
        if(!$this->tokenValidate->scene('check')->check(['token' => $token])){
            throw new ValidateException($this->tokenValidate->getError());
        }
    }
}