<?php
/**
 * Created by PhpStorm.
 * User: xiaoyukarl
 * Date: 2019-07-15
 * Time: 23:21
 */

namespace App\Api\Controller;


use App\Api\Middleware\ApiMiddleware;
use App\Model\Dao\CollectDao;
use App\Model\Data\CollectData;
use App\Model\Logic\CollectLogic;
use App\Model\Service\CollectService;
use App\Utils\Message;
use Swoft\Bean\Annotation\Mapping\Inject;
use Swoft\Http\Message\Request;
use Swoft\Http\Server\Annotation\Mapping\Controller;
use Swoft\Http\Server\Annotation\Mapping\Middleware;
use Swoft\Http\Server\Annotation\Mapping\RequestMapping;
use Swoft\Http\Server\Annotation\Mapping\RequestMethod;

/**
 * @Controller(prefix="/api/collect")
 * @Middleware(ApiMiddleware::class)
 * Class CollectController
 * @package App\Api\Controller
 */
class CollectController
{

    /**
     * @Inject()
     * @var CollectService
     */
    protected $collectService;

    /**
     * @Inject()
     * @var CollectLogic
     */
    protected $collectLogic;

    /**
     * @Inject()
     * @var CollectData
     */
    protected $collectData;

    /**
     * @RequestMapping(route="create", method={RequestMethod::POST})
     * @param Request $request
     * @return array
     * @throws \App\Exception\ValidateException
     */
    public function create(Request $request)
    {
        $data = $request->post();
        $data['userId'] = $request->userId;
        $this->collectLogic->create($data);
        $this->collectService->createCollect($data);
        return Message::success([
            'isCollect' => $data['isCollect']
        ]);
    }

    /**
     * @RequestMapping(route="my_collect", method={RequestMethod::GET})
     * @param Request $request
     * @return array
     */
    public function myCollect(Request $request)
    {
        $page = $request->get('page', 1);
        $collect = $this->collectData->getUserCollect($request->userId, $page);
        return Message::success($collect);
    }

    /**
     * @RequestMapping(route="list", method={RequestMethod::GET})
     * @param Request $request
     * @return array
     */
    public function collect(Request $request)
    {
        $data = $this->collectData->getUserAllCollect($request->userId);
        return Message::success($data);
    }

}