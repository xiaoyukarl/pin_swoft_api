<?php
/**
 * Created by PhpStorm.
 * User: xiaoyukarl
 * Date: 2019-07-08
 * Time: 22:31
 */

namespace App\Api\Controller;


use App\Api\Middleware\ApiMiddleware;
use App\Model\Data\OrdersData;
use App\Model\Logic\OrderLogic;
use App\Model\Service\OrderService;
use App\Utils\Message;
use Swoft\Bean\Annotation\Mapping\Inject;
use Swoft\Http\Message\Request;
use Swoft\Http\Server\Annotation\Mapping\Controller;
use Swoft\Http\Server\Annotation\Mapping\Middleware;
use Swoft\Http\Server\Annotation\Mapping\RequestMapping;
use Swoft\Http\Server\Annotation\Mapping\RequestMethod;

/**
 * @Controller(prefix="/api/order")
 * Class OrderController
 * @package App\Api\Controller
 */
class OrderController
{

    /**
     * @Inject()
     * @var OrdersData
     */
    protected $orderData;

    /**
     * @Inject()
     * @var OrderLogic
     */
    protected $orderLogic;

    /**
     * @Inject()
     * @var OrderService
     */
    protected $orderService;

    /**
     * @RequestMapping(route="home",method={RequestMethod::GET})
     * @param Request $request
     * @return array
     */
    public function home(Request $request)
    {
        $page = $request->get('page', 1);
        $orders = $this->orderData->getHomeOrders($page,1);
        return Message::success($orders);
    }

    /**
     * @RequestMapping(route="search",method={RequestMethod::GET})
     * @param Request $request
     * @return array
     * @throws \ReflectionException
     * @throws \Swoft\Bean\Exception\ContainerException
     * @throws \Swoft\Db\Exception\DbException
     */
    public function search(Request $request)
    {
        //['keyword','destCity','starCity','departureTime','type']
        //出发城市，到达城市，出发时间，关键字（标题和内容）, 类型
        $get = $request->get();
        $page = (int)$request->get('page', 1);
        $orders = $this->orderService->search($get, $page, 1);
        return Message::success($orders);
    }

    /**
     * 获取详情
     * @RequestMapping(route="show/{id}", method={RequestMethod::GET})
     * @param Request $request
     * @param int $id
     * @return array
     * @throws \App\Exception\ApiException
     * @throws \App\Exception\ValidateException
     * @throws \ReflectionException
     * @throws \Swoft\Bean\Exception\ContainerException
     */
    public function show(Request $request, int $id)
    {
        $this->orderLogic->checkId($id);
        $order = $this->orderData->getOrderById($id);
        return Message::success($order);
    }

    /**
     * 获取所有订单
     * @RequestMapping(route="my_order", method={RequestMethod::GET})
     * @Middleware(ApiMiddleware::class)
     * @param Request $request
     * @return mixed
     */
    public function orders(Request $request)
    {
        $page = (int) $request->get('page', 1);
        $data = $this->orderData->getUserOrders($request->userId, $page);
        return Message::success($data);
    }


    /**
     * 用户创建订单
     * @RequestMapping(route="create", method={RequestMethod::POST})
     * @Middleware(ApiMiddleware::class)
     * @param Request $request
     * @return array
     * @throws \App\Exception\ApiException
     * @throws \App\Exception\ValidateException
     */
    public function create(Request $request)
    {
        $data = $request->post();
        $this->orderLogic->create($data);
        $data['userId'] = $request->userId;
        $this->orderService->create($data);
        return Message::success();
    }

    /**
     * 订单详情
     * @Middleware(ApiMiddleware::class)
     * @RequestMapping(route="detail/{id}", method={RequestMethod::GET})
     * @param Request $request
     * @param $id
     * @return array
     * @throws \App\Exception\ApiException
     * @throws \App\Exception\ValidateException
     */
    public function detail(Request $request, int $id)
    {
        $this->orderLogic->checkId($id);
        $order = $this->orderData->getUserOrderById($id, $request->userId);
        return Message::success($order);
    }

    /**
     * 更新订单
     * @RequestMapping(route="update/{id}", method={RequestMethod::POST})
     * @Middleware(ApiMiddleware::class)
     * @param Request $request
     * @param $id
     * @return array
     * @throws \App\Exception\ValidateException
     */
    public function update(Request $request,int $id)
    {
        $data = $request->post();
        $this->orderLogic->update($data);
        $this->orderLogic->checkId($id);
        $this->orderService->updateOrder($data, $id, $request->userId);
        return Message::success();
    }
}