<?php
/**
 * Created by PhpStorm.
 * User: janhuang
 * Date: 16/1/18
 * Time: 下午9:47
 * Github: https://www.github.com/janhuang
 * Coding: https://www.coding.net/janhuang
 * SegmentFault: http://segmentfault.com/u/janhuang
 * Blog: http://segmentfault.com/blog/janhuang
 * Gmail: bboyjanhuang@gmail.com
 * WebSite: http://www.janhuang.me
 */

include __DIR__ . '/../vendor/autoload.php';

use FastD\Swoole\Request;
use FastD\Swoole\Server;

/**
 * Class DemoServer
 */
class DemoServer extends Server
{
    /**
     * @param Request $request
     * @return string
     */
    public function doWork(Request $request)
    {
        return $request->getData();
    }

    /**
     * @param Request $request
     * @return string
     */
    public function doPacket(Request $request)
    {
        return 'udp handle';
    }
}

DemoServer::run([
    'ports' => [
        [
            'host' => '127.0.0.1',
            'port' => '9528',
            'sock' => SWOOLE_SOCK_UDP
        ]
    ]
]);

/**
 * 以上写法和以下写法效果一致
 *
 * $test = new DemoServer();
 * $test->start();
 */
