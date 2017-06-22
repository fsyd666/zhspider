<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace zhspider\http;

use zhspider\core\Base;

class Request extends Base {

    //curl获取文件
    public function get($url, $headers = array()) {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $response = curl_exec($ch);
        if (curl_errno($ch) > 0) {
            $this->log(curl_error($ch));
            return false;
        }
        curl_close($ch);
        if (!$response) {
            $this->log('没有数据!');
            return false;
        }
        return $response;
    }

}
