<?php

/**
 * Description of Spider
 *
 * @author Administrator
 */

namespace zhspider;

use zhspider\core\Engine;

class Spider {

    //run
    public function run() {
        ini_set('max_execution_time', '0');
        error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED);
        $engine = new Engine();
        $engine->run();
    }

}
