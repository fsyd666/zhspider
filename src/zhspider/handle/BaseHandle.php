<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace zhspider\handle;

abstract class BaseHandle {

    protected function createXpath($html) {
        $doc = new \DOMDocument();
        @$doc->loadHTML(mb_convert_encoding($html, 'HTML-ENTITIES'));
        $xpath = new \DOMXPath($doc);
        return $xpath;
    }

    abstract public function getUrls($html, $curUrl);
}
