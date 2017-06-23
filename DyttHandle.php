<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace zhspider\handle;

/**
 * dytt处理器
 */
class DyttHandle extends BaseHandle {

    /**
     * 获取下一个地址
     * @param string $html
     * @return array $urls | null
     */
    public function getUrls($html, $curUrl) {
        //如果是列表URL
        $xpath = $this->createXpath($html, 'gb2312');
        if (preg_match('/list_\d+_\d+\.html$|index.html|\/$/i', $curUrl)) {
            //分页处
            $nodeList = $xpath->query('//div[@class="x"]//a/@href');
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
        $this->getInfo($xpath);
        return null;
    }

    //获取需要的信息
    protected function getInfo($xpath) {
        echo 'h-';
        $nodeList = $xpath->query('//*[@id="Zoom"]');
        if ($nodeList->length == 0) {
            $this->log('没获取到相关的数据 xpath->//*[@id="Zoom"]');
            return false;
        }

        if ($nodeList->length > 0) {
            $str = $nodeList->item(0)->nodeValue;
            file_put_contents('b.txt', $str);
            //解析数据
            $data = $this->parseDy($str);
            //获取图片
            $nodeList = $xpath->query('//*[@id="Zoom"]//img');
            foreach ($nodeList as $v) {
                $tmp[] = $v->getAttribute('src');
            }
            $data['pics'] = json_encode($tmp, JSON_UNESCAPED_UNICODE);
            unset($tmp);

            if ($nodeList->item(0)) {
                $data['pic_title'] = $nodeList->item(0)->getAttribute('src');
            }

            if ($nodeList->item(1)) {
                $data['pic_content'] = $nodeList->item(1)->getAttribute('src');
            }
            //获取下载地址
            $nodeList = $xpath->query('//*[@id="Zoom"]/span/table/tbody/tr/td/a');
            foreach ($nodeList as $v) {
                $tmp[] = $v->nodeValue;
            }
            $data['downurls'] = json_encode($tmp, JSON_UNESCAPED_UNICODE);

            file_put_contents('a.txt', json_encode($data, JSON_UNESCAPED_UNICODE) . "\n", FILE_APPEND);
        }
    }

    protected function parse1() {
        
    }

    //解析movie数据
    protected function parseDy($str) {
        $newArr = array();
        $replace = array(
            'ym' => '译　　名',
            'pm' => '片　　名',
            'nd' => '年　　代',
            'cd' => '产　　地',
            'lb' => '类　　别',
            'yy' => '语　　言',
            'zm' => '字　　幕',
            'syrq' => '上映日期',
            'dbpf' => '豆瓣评分',
            'wjgs' => '文件格式',
            'spcc' => '视频尺寸',
            'wjcd' => '文件大小',
            'pc' => '片　　长',
            'dy' => '导　　演',
            'zy' => '主　　演',
            'jj' => '简　　介',
            'hjqk' => '获奖情况',
        );
        $keys = array();
        $values = array();
        foreach ($replace as $k => $v) {
            $keys[] = $k . '#@#';
            $values[] = $v;
        }
        //去除头尾多余字
        $str = preg_replace(array('/.*?@/im', '/【下载地址】.*/', '/\r\n/'), '', $str);
        $str = str_replace($values, $keys, $str);
        $arr = explode('◎', $str);
        foreach ($arr as $v) {
            $tmp = explode('#@#', $v);
            $newArr[$tmp[0]] = trim($tmp[1], '\t\n\r\0\x0B\x20　');
        }
        return $newArr;
    }

    //解析dsj数据
    protected function parseDsj() {
        
    }

}