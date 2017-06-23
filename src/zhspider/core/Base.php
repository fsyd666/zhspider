<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace zhspider\core;

class Base {

    private $_config = null;

    public function __construct() {
        $this->_config = Config::getInstance();
    }

    public function __get($name) {
        if ($name == 'config') {
            return $this->_config;
        }
        return null;
    }

    protected function log($message) {
        $filename = __DIR__ . '/../logs/' . date('Y-m-d') . '.log';
        file_put_contents($filename, date('H:i:s') . "\t" . $message . "\t" . Config::getInstance()->curUrl . "\n", FILE_APPEND);
    }

}
