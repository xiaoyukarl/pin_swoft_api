<?php declare(strict_types=1);

namespace App\Console\Command;

use Swoft\Console\Annotation\Mapping\Command;
use Swoft\Console\Annotation\Mapping\CommandMapping;
use Swoft\Console\Helper\Show;
use Swoft\Console\Input\Input;
use Swoft\Console\Output\Output;
use Swoole\Timer;

/**
 * Class DemoCommand
 *
 * @Command()
 */
class DemoCommand
{
    /**
     * @CommandMapping()
     * @param Input $input
     */
    public function test(Input $input): void
    {
        Show::prettyJSON([
            'args' => $input->getArgs(),
            'opts' => $input->getOptions(),
        ]);
    }

    /**
     * 定时任务命令触发器,测试
     * @CommandMapping(name="tt")
     * @param Input $input
     * @param Output $output
     * @return int|string
     */
    public function tt(Input $input, Output $output)
    {
        $optionKeys = ['time','name'];
        $options = $input->getOptions();
        foreach ($optionKeys as $key){
            if(!isset($options[$key])){
                $output->error("i don`t understand", false);
                return Show::aList([
                    'time' => 'must be insert time option',
                    'name' => 'must be insert name option'
                ]);
            }
        }

        var_dump($options);
//        Timer::tick(1000, function ()use($options){
//            //echo $options['name'] .'---'. $options['time'] ."\n";
//        });
    }
}
