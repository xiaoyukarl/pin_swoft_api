<?php
/**
 * Created by PhpStorm.
 * User: xiaoyukarl
 * Date: 2019-07-08
 * Time: 22:35
 */

namespace App\Model\Data;


use App\Exception\ApiException;
use App\Model\Dao\OrdersDao;
use Swoft\Bean\Annotation\Mapping\Bean;
use Swoft\Bean\Annotation\Mapping\Inject;

/**
 * @Bean()
 * Class OrdersData
 * @package App\Model\Data
 */
class OrdersData extends BaseData
{

    /**
     * @Inject()
     * @var OrdersDao
     */
    protected $ordersDao;

    public function getHomeOrders($page = 1, $perPage = 15)
    {
        $baseUrl = config('common.baseUrl');
        $paginate = $this->ordersDao->getHomeOrders($page, $perPage);

        $paginate['list'] = $this->parseOrderList($paginate['list']);
        return $paginate;
    }

    public function parseOrderList($list)
    {
        $baseUrl = config('common.baseUrl');
        $orders = [];
        foreach ($list as $order){
            $order['avatarUrl'] = $this->getImgUrl($order['avatar']);
            $order['imgUrl'] = $this->getImgUrl($order['img']);
            $order['imgUrl'] = !empty($order['imgUrl']) ? $order['imgUrl'] : $baseUrl .'images/default.jpg';
            $orders[] = $order;
        }
        return $orders;
    }

    public function getUserOrders($userId, $page = 1, $perPage = 15)
    {
        return $this->ordersDao->getUserOrders($userId, $page, $perPage);
    }

    /**
     * @param $id
     * @return OrdersDao|object|\Swoft\Db\Eloquent\Model|null
     * @throws ApiException
     * @throws \ReflectionException
     * @throws \Swoft\Bean\Exception\ContainerException
     */
    public function getOrderById($id)
    {
        $order = $this->ordersDao->getOrderById($id);
        if(!$order){
            throw new ApiException('数据不存在');
        }
        $order['imgUrl'] = $this->getImgUrl($order['img']);
        $order['avatarUrl'] = $this->getImgUrl($order['avatar']);
        return $order;
    }

    public function getUserOrderById($id, $userId)
    {
        $order = $this->ordersDao->getUserOrderById($id, $userId);
        if(!$order){
            throw new ApiException('数据不存在');
        }
        $order = $order->toArray();
        $order['imgUrl'] = $this->getImgUrl($order['img']);
        return $order;
    }

}