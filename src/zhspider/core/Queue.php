<?php

/**
 * Description of Queue
 * 队列
 * @author Administrator
 */

namespace zhspider\core;

class Queue extends Base {

    //put your code her
    protected $queue = array();
    protected $worked = array();

    public function in($urls) {
        if (empty($urls)) {
            return false;
        }
        if (is_array($urls)) {
            foreach ($urls as $v) {
                $this->inQueue($v);
            }
        } else {
            $this->inQueue($urls);
        }
    }

    protected function inQueue($url) {
        if (empty($url)) {
            return false;
        }
        if (stripos($url, 'javascript:') !== false) { //非地址跳过
            return false;
        }
        //去除#后面的数据  去除.html?jjj  | .htm?dkfkd  | .shtml?www
        $url = preg_replace('/#.*$|\.(html|htm|shtml)\?.*$/i', '', $url);

        if (strpos($url, '/') === 0) { //不带域名的 绝对路径
            $url = $this->config->get('domain') . $url;
        } elseif (strpos($url, 'http') !== 0) {  //既不是http开头也不是 / 开头  就表示是相对路径
            $url = $this->config->curDirname . '/' . $url;
        }

        //如果不是 指定域名跳过
        if (stripos($url, $this->config->get('domain')) !== 0) {
            return false;
        }

        //如果重复 跳过
        if (in_array($url, $this->worked)) {
            return false;
        }

        $this->saveWorked($url);
        $this->saveQueue($url);

        return true;
    }

    public function out() {
        $this->config->curUrl = array_pop($this->queue);
        return $this->config->curUrl;
    }

    protected function saveWorked($url) {
        $this->worked[] = $url;
    }

    public function saveQueue($url) {
        $this->queue[] = $url;
    }

    public function getQueueData() {
        return $this->queue;
    }

    public function getWorkedData() {
        return $this->worked;
    }

}
