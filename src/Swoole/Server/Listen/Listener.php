<?php
/**
 * Created by PhpStorm.
 * User: janhuang
 * Date: 16/5/19
 * Time: 上午1:22
 * Github: https://www.github.com/janhuang
 * Coding: https://www.coding.net/janhuang
 * SegmentFault: http://segmentfault.com/u/janhuang
 * Blog: http://segmentfault.com/blog/janhuang
 * Gmail: bboyjanhuang@gmail.com
 * WebSite: http://www.janhuang.me
 */

namespace FastD\Swoole\Server\Listen;

use FastD\Swoole\Server\Server;
use FastD\Swoole\SwooleInterface;

/**
 * Class Listener
 *
 * @package FastD\Swoole\Server\Listen
 */
class Listener
{
    /**
     * @var string
     */
    protected $host;

    /**
     * @var int|string
     */
    protected $port;

    /**
     * @var int
     */
    protected $mode;

    /**
     * Listener constructor.
     * @param $host
     * @param $port
     * @param int $mode
     */
    public function __construct($host, $port, $mode = SwooleInterface::SWOOLE_SOCK_UDP)
    {
        $this->host = $host;

        $this->port = $port;

        $this->mode = $mode;
    }

    /**
     * @param Server $server
     */
    public function setServer(Server $server)
    {
        $swoole = $server->getServer();

        $listen = $swoole->listen($this->host, $this->port, $this->mode);

        $listen->on('receive', [$this, 'onReceive']);
        $listen->on('connect', [$this, 'onConnect']);
    }

    public function onReceive()
    {

    }

    public function onConnect()
    {

    }
}