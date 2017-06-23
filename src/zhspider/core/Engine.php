<?php

/**
 * Description of Engine
 * 调度器
 * @author Administrator
 */

namespace zhspider\core;

use zhspider\http\Request;
use zhspider\handle\DefaultHandle;

class Engine extends Base {

    protected $queue = null;  //队列对象
    protected $handle = null; //处理器对象

    public function run($config) {
        $this->queue = new Queue();
        //设置配置文件 
        $this->config->setConfig($config);
        $this->queue->in($this->config->get('run_url'));
        $this->handle = $this->createHandle();
        $this->start();
    }

    protected function start() {
        while ($url = $this->queue->out()) {  //取出一个地址
            $request = new Request();
            $html = $request->get($url, $this->config->get('request')['header']);
            //获取新的地址
            if (!$html) { //没有数据跳过
                continue;
            }
            $urls = $this->handle->getUrls($html, $this->config->curUrl);
            $this->queue->in($urls);
            //file_put_contents('a.txt', implode("\n", $this->queue->getWorkedData()) . "\n", FILE_APPEND);
        }
    }

    protected function createHandle() {
        //未设置使用默认处理函数
        if ($this->config->get('handle')) {
            return new DefaultHandle();
        } else {
            return new DefaultHandle();
        }
    }

}
