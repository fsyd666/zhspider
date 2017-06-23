<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace zhspider\core;

/**
 * 使用单例模式
 */
class Config {

    private $_config = null;        //配置信息
    private $_curUrl = null;        //当前URL
    private $_curDirname = null;    //当前URL路径名
    private static $_instance = null;

    private function __construct() {
        $this->_config = array(
            'httpHeader' => array(
                'User-Agent:Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/45.0.2454.101 Safari/537.36',
            ),
            'domain' => '', //必须设置限制在某些域名下抓取 不然碰到友情链接会抓取非常多数据 http://www.ygdy8.com/ 
            'callback' => '', //回调函数
            'run_url' => '', //初始地址 可以是数组或者字符串 http://www.ygdy8.com/html/gndy/china/index.html
            'charset' => 'utf-8',
        );
    }

    private function __clone() {
        //禁止外部克隆
    }

    public function get($name) {
        if (isset($this->_config[$name])) {
            return $this->_config[$name];
        }
        return null;
    }

    public function setConfig($config) {
        $this->_config = array_merge($this->_config, $config);
        //根据地址设置domain
        if (!$this->_config['domain'] && $this->_config['run_url']) {
            $this->_config['domain'] = is_array($this->_config['run_url']) ?
                    $this->getDomain($this->_config['run_url'][0]) :
                    $this->getDomain($this->_config['run_url']);
        }
    }

    public function __get($name) {
        $name = '_' . $name;
        if (isset($this->$name)) {
            return $this->$name;
        }
        return null;
    }

    public function __set($name, $value) {
        if ($name == 'curUrl') {
            $this->_curDirname = dirname($value);
            $this->_curUrl = $value;
            return true;
        }
        return null;
    }

    public static function getInstance() {
        if (self::$_instance === null) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    protected function getDomain($url) {
        $info = parse_url($url);
        if (!$info['scheme'] || !$info['host']) {
            throw new \Exception('run_url is valid');
        }
        return $info['scheme'] . '://' . $info['host'];
    }

}
