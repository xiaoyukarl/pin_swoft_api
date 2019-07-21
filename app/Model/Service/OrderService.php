<?php
/**
 * Created by PhpStorm.
 * User: xiaoyukarl
 * Date: 2019-07-09
 * Time: 10:39
 */

namespace App\Model\Service;

use App\Exception\ApiException;
use App\Model\Dao\OrdersDao;
use App\Model\Data\OrdersData;
use App\Model\Entity\Orders;
use App\Model\Validate\IdValidate;
use Swoft\Bean\Annotation\Mapping\Bean;
use Swoft\Bean\Annotation\Mapping\Inject;

/**
 * @Bean()
 * Class OrderService
 * @package App\Model\Service
 */
class OrderService extends BaseService
{

    /**
     * @Inject()
     * @var OrdersData
     */
    protected $orderData;

    /**
     * @Inject()
     * @var OrdersDao
     */
    protected $orderDao;

    public function updateOrder($data, $id, $userId)
    {
        $order = $this->orderData->getOrderById($id, $userId);

        unset($data['imgUrl']);
        if(!empty($data['img'])){
            $data['img'] = $this->upload('order', $data['img']);
            $path = alias('@base/public/upload/');
            if(!empty($order['img']) && is_file($path . $order['img'])){
                @unlink($path . $order['img']);
            }
        }
        return $this->orderDao->update($data, $id);
    }

    /**
     * @param $data
     * @param $page
     * @param $perPage
     * @return array
     * @throws \ReflectionException
     * @throws \Swoft\Bean\Exception\ContainerException
     * @throws \Swoft\Db\Exception\DbException
     */
    public function search($data, $page = 1, $perPage = 15)
    {
        $orderEntity = new Orders();
        if(isset($data['destCity']) && !empty($data['destCity'])){
            $orderEntity = $orderEntity->where('destCity', $data['destCity']);
        }
        if(isset($data['starCity']) && !empty($data['starCity'])){
            $orderEntity = $orderEntity->where('starCity', $data['starCity']);
        }
        if(isset($data['departureTime']) && !empty($data['departureTime'])){
            $orderEntity = $orderEntity->where('departureTime', $data['departureTime']);
        }
        if(isset($data['type']) && !empty($data['type'])){
            $orderEntity = $orderEntity->where('type', $data['type']);
        }
        if(isset($data['keyword']) && !empty($data['keyword'])){
            $orderEntity = $orderEntity->where('title', 'like', "%".$data['keyword']."%")
                ->where('content', 'like', "%".$data['keyword']."%");
        }
        $paginate = $orderEntity->select('orders.*','users.username','users.avatar')
            ->leftJoin('users', 'users.id', '=', 'orders.userId')
            ->orderBy('id','desc')
            ->where('enable', 1)
            ->paginate($page, $perPage);

        $paginate['list'] = $this->orderData->parseOrderList($paginate['list']);
        return  $paginate;
    }

    public function create($data)
    {
        try{
            if(!empty($data['img'])){
                $data['img'] = $this->upload('order', $data['img']);
            }
            return $this->orderDao->create($data);
        }catch (\Exception $exception) {
            throw new ApiException("插入数据失败", 5002);
        }
    }

}