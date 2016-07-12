<?php
/**
 * Created by PhpStorm.
 * User: janhuang
 * Date: 16/3/7
 * Time: 上午11:50
 * Github: https://www.github.com/janhuang
 * Coding: https://www.coding.net/janhuang
 * SegmentFault: http://segmentfault.com/u/janhuang
 * Blog: http://segmentfault.com/blog/janhuang
 * Gmail: bboyjanhuang@gmail.com
 * WebSite: http://www.janhuang.me
 */

namespace FastD\Swoole\Http;

use FastD\Http\JsonResponse;
use FastD\Http\RedirectResponse;
use FastD\Http\Response;
use FastD\Http\SwooleRequest;
use FastD\Swoole\Server\Server;

/**
 * Class HttpServer
 *
 * @package FastD\Swoole\Server
 */
abstract class HttpServer extends Server implements HttpServerInterface
{
    const GZIP_LEVEL = 4;

    public function json(array $content)
    {
        return new JsonResponse($content);
    }

    public function html($content)
    {
        return new Response($content);
    }

    public function redirect($url)
    {
        return new RedirectResponse($url);
    }

    /**
     * @return \swoole_server
     */
    public function initSwoole()
    {
        return new \swoole_http_server($this->host, $this->port, $this->mode, $this->sockType);
    }

    /**
     * @param \swoole_http_request $request
     * @param \swoole_http_response $response
     */
    public function onRequest(\swoole_http_request $request, \swoole_http_response $response)
    {
        $request = SwooleRequest::createSwooleRequestHandle($request);

        $returnResponse = $this->doRequest($request);

        foreach ($returnResponse->getHeader()->all() as $key => $value) {
            $response->header($key, $value);
        }

        $response->gzip(static::GZIP_LEVEL);
        $response->status($returnResponse->getStatusCode());
        $response->end($returnResponse->getContent());

        unset($request, $returnResponse);
    }

    /**
     * Nothing to do.
     *
     * @param \swoole_server $server
     * @param int $fd
     * @param int $from_id
     * @param string $data
     * @return mixed
     */
    public function doWork(\swoole_server $server, int $fd, int $from_id, string $data)
    {
        return;
    }

    /**
     * Nothing to do.
     *
     * @param \swoole_server $server
     * @param int $task_id
     * @param int $from_id
     * @param string $data
     * @return mixed
     */
    public function doTask(\swoole_server $server, int $task_id, int $from_id, string $data)
    {
        return;
    }

    /**
     * @param \swoole_server $server
     * @param string $data
     * @param array $client_info
     */
    public function doPacket(\swoole_server $server, string $data, array $client_info)
    {
        return;
    }
}