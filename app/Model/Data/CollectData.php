<?php
/**
 * Created by PhpStorm.
 * User: xiaoyukarl
 * Date: 2019-07-16
 * Time: 09:21
 */

namespace App\Model\Data;

use App\Model\Dao\CollectDao;
use Swoft\Bean\Annotation\Mapping\Bean;
use Swoft\Bean\Annotation\Mapping\Inject;

/**
 * @Bean()
 * Class CollectData
 * @package App\Model\Data
 */
class CollectData
{

    /**
     * @Inject()
     * @var CollectDao
     */
    protected $collectDao;


    public function getUserCollect($userId, $page = 1, $perPage = 15)
    {
        $paginate = $this->collectDao->getCollectByUser($userId, $page, $perPage);

        $data = [];
        foreach ($paginate['list'] as $collect){
            $data[$collect['orderId']] = $collect;
        }
        $paginate['list'] = $data;
        return $paginate;
    }

    public function getUserAllCollect($userId)
    {
        $collectData = $this->collectDao->getUserAllCollect($userId);
        $data = [];
        foreach ($collectData->toArray() as $collect){
            $data[$collect['orderId']] = $collect['isCollect'];
        }
        return $data;
    }
}