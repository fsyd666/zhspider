<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once __DIR__ . '/ClassLoader.php';
spl_autoload_register("ClassLoader::autoload");

$spider = new zhspider\Spider();
$spider->run(
        array(
            'run_url' => 'http://www.ygdy8.net/html/gndy/china/index.html',
            'callback' => 'cal',
            'charset' => 'gb2312',
        )
);

function cal($html, $curUrl, $xpath) {
    if (preg_match('/list_\d+_\d+\.html$|index.html|\/$/i', $curUrl)) {
        //分页处
        $nodeList = $xpath->query('//div[@class="x"]//a/@href');
        $urls = array();
        foreach ($nodeList as $node) {
            $urls[] = $node->nodeValue;
        }
        //列表处
        $nodeList = $xpath->query('//div[@class="co_content8"]//b/a[2]/@href');
        foreach ($nodeList as $node) {
            $urls[] = $node->nodeValue;
        }
        return $urls;
    } else {
        echo 'h-';
    }
}
