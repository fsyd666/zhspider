<?php

/**
 * Description of Spider
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
