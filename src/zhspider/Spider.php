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
        $engine = new Engine();
        $engine->run();
    }

}
