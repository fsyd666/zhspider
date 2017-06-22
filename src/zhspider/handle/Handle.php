<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace zhspider\handle;

class Handle extends HandleBase {

    /**
     * 获取下一个地址
     * @param string $html
     * @return array $urls
     */
    public function getUrls($html) {
        $nodeList = $this->createXpath($html)->query('//a/@href');
        $urls = array();
        foreach ($nodeList as $node) {
            $urls[] = $node->nodeValue;
        }
        print_r($urls);
        return $urls;
    }

}
