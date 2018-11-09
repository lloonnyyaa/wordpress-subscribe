<?php

namespace vds\component;

use vds\controller\AdminOptionController;
use vds\controller\AdminPostController;
use vds\controller\FrontController;

class Plugin {

    const VERSION = '1.0.0';
    const NAME = 'Viaduct subscribe';
    const SHORT_NAME = 'vd_subscribe';

    public static $path;
    public static $url;
    public static $options_controllers;

    public static function run() {
        self::$options_controllers = new AdminOptionController();
        new FrontController();
        new AdminPostController();
    }

}
