<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once __DIR__ . '/ClassLoader.php';
spl_autoload_register("ClassLoader::autoload");

$spider = new zhspider\Spider();
$spider->run();
