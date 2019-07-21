<?php declare(strict_types=1);


namespace App\Model\Dao;


use App\Model\Entity\User;
use App\Model\Entity\Users;
use Swoft\Bean\Annotation\Mapping\Bean;


/**
 * @Bean()
 * Class UserDao
 * @package App\Model\Dao
 */
class UserDao
{

    /**
     * 保存用户信息
     * @param array $data
     * @return bool
     * @throws \ReflectionException
     * @throws \Swoft\Bean\Exception\ContainerException
     * @throws \Swoft\Db\Exception\DbException
     */
    public function create(array  $data)
    {
        return Users::create($data)->save();
    }

    /**
     * 更新或插入
     * @param $condition
     * @param $data
     * @return Users
     */
    public function updateOrCreate($condition, $data)
    {
        return Users::updateOrCreate($condition, $data);
    }

    /**
     * @param $openId
     * @return object|\Swoft\Db\Eloquent\Builder|\Swoft\Db\Eloquent\Model|null
     * @throws \ReflectionException
     * @throws \Swoft\Bean\Exception\ContainerException
     * @throws \Swoft\Db\Exception\DbException
     */
    public function getUserByOpenId($openId)
    {
        return Users::where('openId', $openId)->first();
    }

    /**
     * @param $data
     * @param $userId
     * @return int
     * @throws \ReflectionException
     * @throws \Swoft\Bean\Exception\ContainerException
     * @throws \Swoft\Db\Exception\DbException
     */
    public function updateUserInfo($data, $userId)
    {
        return Users::where('id', $userId)->update($data);
    }

    /**
     * @param $userId
     * @return Users
     */
    public function getUserById($userId)
    {
        return Users::find($userId);
    }

}