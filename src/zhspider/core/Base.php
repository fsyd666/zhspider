<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace zhspider\core;

class Base {

    private $_config = array();
    protected $curUrl = null;
    protected $domain = null;

    protected function __get($name) {
        return $this->_config;
    }

    public function __construct() {
        $this->_config = require __DIR__ . '/../config/config.php';
    }

}
