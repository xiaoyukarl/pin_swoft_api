<?php
/**
 * Created by PhpStorm.
 * User: xiaoyukarl
 * Date: 2019-07-15
 * Time: 23:25
 */

namespace App\Model\Logic;


use App\Exception\ValidateException;
use App\Model\Validate\CollectValidate;
use Swoft\Bean\Annotation\Mapping\Bean;
use Swoft\Bean\Annotation\Mapping\Inject;

/**
 * @Bean()
 * Class CollectLogic
 * @package App\Model\Logic
 */
class CollectLogic
{

    /**
     * @Inject()
     * @var CollectValidate
     */
    protected $collectValidate;

    public function create($data)
    {
        if(!$this->collectValidate->check($data)){
            throw new ValidateException($this->collectValidate->getError());
        }
    }

}