<?php

/**
 * Description of Engine
 * 调度器
 * @author Administrator
 */

namespace zhspider\core;

use zhspider\http\Request;
use zhspider\handle\Handle;

class Engine extends Base {

    protected $queue = null;
    protected $handle = null;

    public function run($url) {
        $this->queue = new Queue();
        $this->queue->in($url);
        $this->handle = $this->createHandle();
        $this->start();
    }

    protected function start() {
        while ($url = $this->queue->out()) {  //取出一个地址
            $html = Request::get($url);
            //获取新的地址
            $urls = $this->handle->getUrls($html);
            $this->queue->in($urls);
        }
    }

    protected function createHandle() {
        if ($this->config['handle']) {
            $class = $this->config['handle'];
            return new $class();
        } else {
            return new Handle();
        }
    }

}
