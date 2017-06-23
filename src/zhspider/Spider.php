<?php

/**
 * config 配置信息 array(
 *      'httpHeader' => array(),  //http 请求头
 *      'run_url'=>'', //必须   跑的uRL  多个地址就用 array('url1','url2');
 *      'callback'=>'',//必须   回调函数 ，如果是对象方法 array($obj,'fun');
 *      'charset' => 'utf-8'  //页面字符编码  
 * )
 * 
 * callback() 接收三个参数
 * $html  //当前获取的 html
 * $curUrl  //当前所抓取的 url
 * $xpath  //一个DomXpath对象
 *  
 * @author Administrator
 */

namespace zhspider;

use zhspider\core\Engine;

class Spider {

    /**
     * 
     * @param array $config  配置文件信息
     */
    public function run($config = null) {
        ini_set('max_execution_time', '0');
        error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED);
        $engine = new Engine();
        $engine->run($config);
    }

}
