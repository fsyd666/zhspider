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
        $this->_config = require __DIR__ . '/../config/config.php';
        if (!$this->_config['domain']) {
            throw new \Exception('config no set domain', 500);
        }
        $this->_config['domain'] = rtrim($this->_config['domain'], '/');

        if (!$this->_config['run_url']) {
            throw new \Exception('no run url!', 500);
        }
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

}
