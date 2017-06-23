<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace zhspider\handle;
use zhspider\core\Base;

abstract class BaseHandle extends Base{

    protected function createXpath($html,$charset='utf-8') {
        $doc = new \DOMDocument();
        @$doc->loadHTML(mb_convert_encoding($html, 'HTML-ENTITIES',$charset));
        $xpath = new \DOMXPath($doc);
        return $xpath;
    }

    abstract public function getUrls($html, $curUrl);
}
