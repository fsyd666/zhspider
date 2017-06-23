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

    protected $queue = null;  //队列对象
    protected $handle = null; //处理器对象

    public function run($config) {
        $this->queue = new Queue();
        //设置配置文件
        $this->config->setConfig($config);
        //设置配置文件 
        $this->validConfig();
        $this->queue->in($this->config->get('run_url'));
        $this->handle = new Handle();
        $this->start();
    }

    protected function start() {
        while ($url = $this->queue->out()) {  //取出一个地址
            $request = new Request();
            $html = $request->get($url);
            //获取新的地址
            if (!$html) { //没有数据跳过
                continue;
            }
            $urls = $this->handle->getUrls($html);
            $this->queue->in($urls);
        }
    }

    protected function validConfig() {
        //必须设置run_url,callback;
        if (!$this->config->get('run_url')) {
            throw new \Exception('no set run_url');
        }
        if (!$this->config->get('callback')) {
            throw new \Exception('no set callback');
        }
    }

}
