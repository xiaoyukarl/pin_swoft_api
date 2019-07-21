<?php
/**
 * Created by PhpStorm.
 * User: xiaoyukarl
 * Date: 2019-06-27
 * Time: 23:19
 */

namespace App\Http\Controller;


use App\Aop\Annotation\Test;
use App\Bean\TestBean;
use App\Exception\ApiException;
use App\Model\Entity\User;
use App\Utils\Sms;
use Swoft\Bean\Annotation\Mapping\Inject;
use Swoft\Context\Context;
use Swoft\Db\DB;
use Swoft\Http\Message\ContentType;
use Swoft\Http\Message\Request;
use Swoft\Http\Server\Annotation\Mapping\Controller;
use Swoft\Http\Server\Annotation\Mapping\RequestMapping;
use Swoft\Log\Helper\Log;
use Swoft\Redis\Pool;
use Swoft\Redis\Redis;
use Swoft\Task\Task;
use Toolkit\Cli\App;

/**
 * @Controller("test")
 * Class TestController
 * @package App\Http\Controller
 */
class TestController
{
    /**
     * @Inject()
     * @var TestBean
     */
    private $testBean;

    /**
     * @RequestMapping("/test/index/{age}")
     * @param int $age
     * @return string
     */
    public function index(int $age) :string
    {
        $this->testBean->setName("my name is karl ");

        return $this->testBean->getName() . ", now " . $age;
    }

    /**
     * @RequestMapping("/test/event")
     */
    public function event()
    {
        $params = [
            'this is event',
            'handel'
        ];
        \Swoft::trigger('test.event1', '', $params);
        return 'trigger ok';
    }

    /**
     * @RequestMapping
     * @return array
     * @throws \ReflectionException
     * @throws \Swoft\Bean\Exception\ContainerException
     */
    public function env():array
    {
        $config = \Swoft::getBean('config')->get();
        return $config;
    }

    /**
     * @RequestMapping()
     */
    public function select()
    {
        $user = User::paginate(1,2);
        return $user;
    }


    /**
     * @Inject()
     * @var Pool
     */
    protected $redis;

    /**
     * @RequestMapping()
     * @return bool|mixed
     */
    public function redis()
    {
        $this->redis->set('name', 'karl', 20);

        return $this->redis->get('name');
    }

    /**
     * @RequestMapping(route="task")
     * @throws \Swoft\Task\Exception\TaskException
     */
    public function task()
    {
        return Task::co('mytask', 'tt',[1,3]);
    }

    /**
     * @RequestMapping()
     * @return array
     * @throws \Swoft\Task\Exception\TaskException
     */
    public function send()
    {
        $params = ['18823021014','4231'];
        Task::co('sms', 'sendCode', $params);
        return $params;
    }

    /**
     * @RequestMapping(route="point")
     * @param Request $request
     * @return array
     * @throws \ReflectionException
     * @throws \Swoft\Bean\Exception\ContainerException
     */
    public function point(Request $request)
    {
        Log::pushLog('request data', $request->get());
        echo "this is point action".PHP_EOL;
//        throw new ApiException('test exception');
        return ["point"];
    }

    /**
     * PointBean
     * @RequestMapping(route="pb")
     * @return string
     * @throws \ReflectionException
     * @throws \Swoft\Bean\Exception\ContainerException
     */
    public function pb()
    {
        $testBean = \Swoft::getBean('test');
        return $testBean->getName();
    }

    /**
     * @RequestMapping(route="anno")
     * @Test(name="xiao")
     */
    public function anno()
    {
        return [Test::class];
    }

    /**
     * @RequestMapping()
     * @return \Swoft\Http\Message\Response|\Swoft\WebSocket\Server\Message\Response
     * @throws \ReflectionException
     * @throws \Swoft\Bean\Exception\ContainerException
     * @throws \Throwable
     */
    public function chat()
    {
        $renderer = \Swoft::getBean('view');
        $content  = $renderer->render('home/ws');
        return Context::mustGet()->getResponse()
            ->withContentType(ContentType::HTML)
            ->withContent($content);
    }


}