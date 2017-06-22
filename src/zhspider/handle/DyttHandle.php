<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace zhspider\handle;

class DyttHandle extends BaseHandle {

    /**
     * 获取下一个地址
     * @param string $html
     * @return array $urls | null
     */
    public function getUrls($html, $curUrl) {
        //如果是列表URL
        if (preg_match('/list_\d+_\d+\.html$|index.html|\/$/i', $curUrl)) {
            //分页处
            $nodeList = $this->createXpath($html)->query('//div[@class="x"]//a/@href');
            print_r($nodeList);
            $urls = array();
            foreach ($nodeList as $node) {
                $urls[] = $node->nodeValue;
            }
            //列表处
            $nodeList = $this->createXpath($html)->query('//div[@class="co_content8"]//b/a[2]/@href');
            foreach ($nodeList as $node) {
                $urls[] = $node->nodeValue;
            }
            return $urls;
        }
        //如果是详情链接类型
        $this->getInfo($html);
        return null;
    }

    //获取需要的信息
    protected function getInfo($html) {
        echo "hhh";
    }

}
