<?php

//key => value
$config = array(
    'request' => array(
        'header' => array(
            'User-Agent:Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/45.0.2454.101 Safari/537.36',
        ),
    ),
    'domain' => array(), //限制在某些域名下抓取 默认只抓取当前域名
    'handle' => 'Handle', //处理器必须继承  HandleBase 并且必须使用 zhspider\handle 命名空间
);
return $config;
