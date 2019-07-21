<?php
/**
 * Created by PhpStorm.
 * User: xiaoyukarl
 * Date: 2019-07-08
 * Time: 22:33
 */

namespace App\Model\Dao;


use App\Model\Entity\Orders;
use Swoft\Bean\Annotation\Mapping\Bean;

/**
 * @Bean()
 * Class OrdersDao
 * @package App\Model\Dao
 */
class OrdersDao
{

    public function getHomeOrders($page = 1, $perPage = 15)
    {
        return Orders::select('orders.*','users.username','users.avatar')
            ->leftJoin('users', 'users.id', '=', 'orders.userId')
            ->orderBy('id','desc')
            ->where('enable', 1)
            ->paginate($page, $perPage);
    }

    public function getUserOrders($userId, $page = 1, $perPage = 15)
    {
        return Orders::where('userId', $userId)
            ->where('enable', 1)
            ->orderBy('id','desc')
            ->paginate($page, $perPage);
    }

    public function getOrderById($id)
    {
        return Orders::select('orders.*','users.username','users.avatar')
            ->leftJoin('users','users.id','=','orders.userId')
            ->where('orders.id', $id)
            ->where('enable', 1)
            ->first();
    }

    public function getUserOrderById($id, $userId)
    {
        return Orders::where('id',$id)
            ->where('enable', 1)
            ->where('userId', $userId)
            ->first();
    }

    public function update($data, $id)
    {
        return Orders::where('id', $id)->update($data);
    }

    public function create($data)
    {
        return Orders::create($data);
    }
}