<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace zhspider\handle;

use zhspider\core\Base;

/**
 * 默认处理器
 */
class Handle extends Base {

    protected function createXpath($html, $charset = 'utf-8') {
        $doc = new \DOMDocument();
        @$doc->loadHTML(mb_convert_encoding($html, 'HTML-ENTITIES', $charset));
        $xpath = new \DOMXPath($doc);
        return $xpath;
    }

    /**
     * 获取下一个地址
     * @param string $html
     * @return array $urls
     */
    public function getUrls($html, $curUrl) {
        if (!$curUrl) {  //没有URL 直接返回
            return null;
        }
        $nodeList = $this->createXpath($html)->query('//a/@href');
        $urls = array();
        foreach ($nodeList as $node) {
            $urls[] = $node->nodeValue;
        }
        return $urls;
    }

}
