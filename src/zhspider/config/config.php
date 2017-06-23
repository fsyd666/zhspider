<?php

//key => value
$config = array(
    'header' => array(
        'User-Agent:Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/45.0.2454.101 Safari/537.36',
    ),
    'domain' => '', //必须设置限制在某些域名下抓取 不然碰到友情链接会抓取非常多数据 http://www.ygdy8.com/ 
    'handle' => '', //回调函数
    'run_url' => '', //初始地址 可以是数组或者字符串 http://www.ygdy8.com/html/gndy/china/index.html
);
return $config;
