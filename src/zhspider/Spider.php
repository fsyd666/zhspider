<?php

/**
 * Description of Spider
 *
 * @author Administrator
 */

namespace zhspider;

require_once __DIR__ . '/ClassLoader.php';
spl_autoload_register("ClassLoader::autoload");

use zhspider\core\Base;
use zhspider\core\Engine;

class Spider extends Base {

    //run
    public function run($url) {
        $engine = new Engine();
        $engine->run($url);
    }

}
