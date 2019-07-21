<?php declare(strict_types=1);


namespace App\Model\Logic;


use App\Exception\ApiException;
use App\Exception\ValidateException;
use App\Model\Validate\UserValidate;
use Swoft\Bean\Annotation\Mapping\Bean;
use Swoft\Bean\Annotation\Mapping\Inject;

/**
 * @Bean()
 * Class UserLogic
 * @package App\Model\Logic
 */
class UsersLogic
{

    /**
     * @Inject()
     * @var UserValidate
     */
    protected $userValidate;

    public function login($data)
    {
        if(!$this->userValidate->scene('login')->check($data)){
            throw new ValidateException($this->userValidate->getError());
        }
    }

    public function update($data)
    {
        if(!$this->userValidate->scene('update')->check($data)){
            throw new ValidateException($this->userValidate->getError());
        }
    }

    public function wxlogin($data)
    {
        if(!$this->userValidate->scene('wxlogin')->check($data)){
            throw new ValidateException($this->userValidate->getError());
        }
    }
}