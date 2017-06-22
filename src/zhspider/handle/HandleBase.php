<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace zhspider\handle;

abstract class HandleBase {

    protected function createXpath($html) {
        $doc = new \DOMDocument();
        $doc->loadHTML($html);
        $xpath = new DOMXPath($doc);
        return $xpath;
    }

    abstract public function getUrls($html);
}
