<?php
/**
 * Created by PhpStorm.
 * User: xiaoyukarl
 * Date: 2019-07-15
 * Time: 23:14
 */

namespace App\Model\Dao;


use App\Model\Entity\Collect;
use Swoft\Bean\Annotation\Mapping\Bean;

/**
 * @Bean()
 * Class CollectDao
 * @package App\Model\Dao
 */
class CollectDao
{

    public function getCollectByUser($userId, $page = 1, $perPage = 15)
    {
        return Collect::select('collect.*','orders.title','orders.destCity','orders.starCity','orders.departureTime','orders.type')
            ->leftJoin('orders', 'orders.id','=', 'collect.orderId')
            ->where('collect.userId', $userId)
            ->where('orders.enable', 1)
            ->orderBy('collect.id','desc')
            ->paginate($page, $perPage);
    }

    public function getUserAllCollect($userId)
    {
        return Collect::where('userId', $userId)->get();
    }

    public function createCollect($data)
    {
        return Collect::create($data);
    }

    public function createOrUpdate($condition, $data)
    {
        return Collect::updateOrCreate($condition, $data);
    }
}