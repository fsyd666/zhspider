<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class ClassLoader {

    public static function autoload($class) {

        $class = str_replace('\\', '/', $class);
        $file = __DIR__ . '/src/' . $class . '.php';
        if (file_exists($file)) {
            require $file;
        }
    }

}
