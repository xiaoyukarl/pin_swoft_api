<?php

use App\Common\DbSelector;
use Swoft\Db\Pool;
use Swoft\Http\Server\HttpServer;
use Swoft\Task\Swoole\TaskListener;
use Swoft\Task\Swoole\FinishListener;
use Swoft\Rpc\Client\Client as ServiceClient;
use Swoft\Rpc\Client\Pool as ServicePool;
use Swoft\Rpc\Server\ServiceServer;
use Swoft\Http\Server\Swoole\RequestListener;
use Swoft\WebSocket\Server\WebSocketServer;
use Swoft\Server\Swoole\SwooleEvent;
use Swoft\Db\Database;
use Swoft\Redis\RedisDb;

return [
    'lineFormatter'      => [
        'format'     => '%datetime% [%level_name%] [%channel%] [%event%] [tid:%tid%] [cid:%cid%] [traceid:%traceid%] [spanid:%spanid%] [parentid:%parentid%] %messages%',
        'dateFormat' => 'Y-m-d H:i:s',
    ],
    'noticeHandler'      => [
        'class'     => \Swoft\Log\Handler\FileHandler::class,
        'logFile'   => '@runtime/logs/notice.log',
        'formatter' => \bean('lineFormatter'),
        'levels'    => [
            \Swoft\Log\Logger::NOTICE,
            \Swoft\Log\Logger::INFO,
            \Swoft\Log\Logger::DEBUG,
            \Swoft\Log\Logger::TRACE,
        ],
    ],
    'applicationHandler' => [
        'class'     => \Swoft\Log\Handler\FileHandler::class,
        'logFile'   => '@runtime/logs/error.log',
        'formatter' => \bean('lineFormatter'),
        'levels'    => [
            \Swoft\Log\Logger::ERROR,
            \Swoft\Log\Logger::WARNING,
        ],
    ],
    'logger'             => [
        'flushRequest' => false,
        'enable'       => true,
        'json'         => true,
        'handlers'     => [
            'application' => \bean('applicationHandler'),
            'notice'      => \bean('noticeHandler'),
        ],
    ],
    'httpServer' => [
        'class'    => HttpServer::class,
        'port'     => 18306,
        'listener' => [
            'rpc' => bean('rpcServer')
        ],
        'on'       => [
            SwooleEvent::TASK   => bean(TaskListener::class),  // Enable task must task and finish event
            SwooleEvent::FINISH => bean(FinishListener::class)
        ],
        /* @see HttpServer::$setting */
        'setting'  => [
            'task_worker_num'       => 12,
            'task_enable_coroutine' => true,
            // enable static handle
            'enable_static_handler' => true,
            // swoole v4.4.0以下版本, 此处必须为绝对路径
            'document_root'         => dirname(__DIR__) . '/public',
        ]
    ],
    'httpDispatcher' => [
        // Add global http middleware
        'middlewares' => [
            // Allow use @View tag
            \Swoft\View\Middleware\ViewMiddleware::class,
        ],
    ],
    'db'         => [
        'class'    => Database::class,
        'dsn'      => 'mysql:dbname=pin;host=23.106.134.251',
        'username' => 'xiaoyukarl',
        'password' => 'xiaoyukarl',
    ],
    'db2'        => [
        'class'      => Database::class,
        'dsn'        => 'mysql:dbname=test2;host=172.17.0.3',
        'username'   => 'root',
        'password'   => 'swoft123456',
        'dbSelector' => bean(DbSelector::class)
    ],
    'db2.pool'   => [
        'class'    => Pool::class,
        'database' => bean('db2')
    ],
    'db3'        => [
        'class'    => Database::class,
        'dsn'      => 'mysql:dbname=test2;host=172.17.0.3',
        'username' => 'root',
        'password' => 'swoft123456'
    ],
    'db3.pool'   => [
        'class'    => Pool::class,
        'database' => bean('db3')
    ],
    'redis'      => [
        'class'    => RedisDb::class,
        'host'     => '23.106.134.251',
        'port'     => 6379,
        'database' => 0,
        'password' => 'xiaoyukarl',
        'option'        => [
            'prefix'      => 'pin_',
        ],
    ],
    'rpcServer'  => [
        'class' => ServiceServer::class,
    ],
    'wsServer'   => [
        'class'   => WebSocketServer::class,
        'on'      => [
            // Enable http handle
            SwooleEvent::REQUEST => bean(RequestListener::class),
        ],
        'debug'   => env('SWOFT_DEBUG', 0),
        /* @see WebSocketServer::$setting */
        'setting' => [
            'log_file' => alias('@runtime/swoole.log'),
        ],
    ],
    'view' => [
        //模板文件目录
        'viewsPath' => dirname(__DIR__) . '/resource/views/',
        //默认的布局文件
        'layout' => dirname(__DIR__) . '/resource/views/layouts/default.php',
    ],
];
