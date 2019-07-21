<?php declare(strict_types=1);


namespace App\Model\Data;


use App\Model\Dao\UserDao;
use App\Model\Entity\User;
use App\Model\Entity\Users;
use Swoft\Bean\Annotation\Mapping\Bean;
use Swoft\Bean\Annotation\Mapping\Inject;

/**
 * @Bean()
 * Class UsersData
 * @package App\Model\Data
 */
class UsersData extends BaseData
{
    /**
     * @Inject()
     * @var UserDao
     */
    protected $userDao;

    public function getUserInfo($userId)
    {
        $user = $this->setTag('userInfo')
            ->setModel(new Users())
            ->setTtl(3600)
            ->remember($userId, function ()use($userId){
                return $this->getModel()->find($userId);
            });
        return $user;
    }

    public function resetUserInfo($userId)
    {
        return $this->setTag('userInfo')
            ->setModel(new Users())
            ->setTtl(3600)
            ->reset($userId, function ()use($userId){
                return $this->getModel()->find($userId);
            });
    }

    public function updateUserInfo($data, $userId)
    {
        return $this->userDao->updateUserInfo($data, $userId);
    }


}