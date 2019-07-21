<?php
/**
 * Created by PhpStorm.
 * User: xiaoyukarl
 * Date: 2019-06-30
 * Time: 14:59
 */

namespace App\Model\Data;


use Swoft\Bean\Annotation\Mapping\Bean;
use Swoft\Bean\Annotation\Mapping\Inject;
use Swoft\Redis\Pool;

/**
 * @Bean()
 * Class RepositoryData
 * @package App\Model\Data
 */
class RepositoryData
{
    protected $ttl = 3600;

    protected $tag = '';

    protected $model;

    /**
     * @Inject()
     * @var Pool
     */
    protected $redis;

    /**
     * @return int
     */
    public function getTtl(): int
    {
        return $this->ttl;
    }

    /**
     * @param int $ttl
     * @return $this
     */
    public function setTtl(int $ttl)
    {
        $this->ttl = $ttl;
        return $this;
    }

    /**
     * @return string
     */
    public function getTag(): string
    {
        return $this->tag;
    }

    /**
     * @param string $tag
     * @return $this
     */
    public function setTag(string $tag)
    {
        $this->tag = $tag;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * @param $model
     * @return $this
     */
    public function setModel($model)
    {
        $this->model = $model;
        return $this;
    }

    public function getUserById($userId)
    {
        return $this->remember($userId, function ()use($userId){
            return $this->getModel()->select('id')->find($userId);
        });
    }


    /**
     * 缓存
     * @param $code
     * @param \Closure $entity
     * @return bool|mixed
     */
    public function remember($code, \Closure $entity)
    {
        $key = $this->getTag() . ':' . $code;
        $value = $this->redis->get($key);
        if(empty($value)){
            $value = $entity();
            if(!empty($value)){
                $this->redis->set($key, $value, $this->getTtl());
            }
        }
        return $value;
    }

    /**
     * 重新缓存，信息更新之后会用到
     * @param $code
     * @param \Closure $entity
     * @return mixed
     */
    public function reset($code, \Closure $entity)
    {
        $key = $this->getTag() . ':' . $code;
        $value = $entity();
        if(!empty($value)){
            $this->redis->set($key, $value, $this->getTtl());
        }
        return $value;
    }


}