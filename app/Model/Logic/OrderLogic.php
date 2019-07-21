<?php
/**
 * Created by PhpStorm.
 * User: xiaoyukarl
 * Date: 2019-07-09
 * Time: 10:41
 */

namespace App\Model\Logic;


use App\Exception\ValidateException;
use App\Model\Validate\IdValidate;
use App\Model\Validate\OrderValidate;
use Swoft\Bean\Annotation\Mapping\Bean;
use Swoft\Bean\Annotation\Mapping\Inject;

/**
 * @Bean()
 * Class OrderLogic
 * @package App\Model\Logic
 */
class OrderLogic
{
    /**
     * @Inject()
     * @var IdValidate
     */
    protected $idValidate;

    /**
     * @Inject()
     * @var OrderValidate
     */
    protected $orderValidate;

    public function checkId($id)
    {
        if(!$this->idValidate->check(['id'=>$id])){
            throw new ValidateException($this->idValidate->getError());
        }
    }

    public function create($data)
    {
        if(!$this->orderValidate->scene('create')->check($data)){
            throw new ValidateException($this->orderValidate->getError());
        }
    }

    public function update($data)
    {
        if(!$this->orderValidate->scene('update')->check($data)){
            throw new ValidateException($this->orderValidate->getError());
        }
    }
}