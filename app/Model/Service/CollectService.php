<?php
/**
 * Created by PhpStorm.
 * User: xiaoyukarl
 * Date: 2019-07-15
 * Time: 23:17
 */

namespace App\Model\Service;

use App\Model\Dao\CollectDao;
use Swoft\Bean\Annotation\Mapping\Bean;
use Swoft\Bean\Annotation\Mapping\Inject;

/**
 * @Bean()
 * Class CollectService
 * @package App\Model\Service
 */
class CollectService
{

    /**
     * @Inject()
     * @var CollectDao
     */
    protected $collectDao;

    public function createCollect($data)
    {
        $data['isCollect'] = isset($data['isCollect']) ? $data['isCollect'] : 1;
        $condition = [
            'userId' => $data['userId'],
            'orderId' => $data['orderId']
        ];
        return $this->collectDao->createOrUpdate($condition, $data);
    }

}