<?php
/**
 * Created by PhpStorm.
 * User: xiaoyukarl
 * Date: 2019-07-06
 * Time: 10:53
 */

namespace App\Aop\Annotation;


use Doctrine\Common\Annotations\Annotation;
use Doctrine\Common\Annotations\Annotation\Target;

/**
 * @Annotation
 * @Target("ALL")
 * Class TestAnnotation
 * @package App\Aop\Annotation
 */
class Test
{

    /**
     * @var string
     */
    protected $name;

    public function __construct($params)
    {
        if(isset($params['name'])){
            $this->name = $params['name'];
        }
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param $name
     * @return string
     */
    public function setName($name): string
    {
        $this->name = $name;
        return $this;
    }
}