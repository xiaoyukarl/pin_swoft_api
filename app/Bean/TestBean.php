<?php
declare(strict_types=1);

namespace App\Bean;
/**
 * Description of TestBean
 * Date 2019/6/25
 * @author xiaoyukarl
 */

use Swoft\Bean\Annotation\Mapping\Bean;

/**
 * @Bean(name="test")
 * Class TestBean
 * @package App\Bean
 */
class TestBean
{

    /**
     * @var string
     */
    protected $name = 'this is a test bean';

    /**
     * @param string $name
     * @return $this
     */
    public function setName(string $name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

}